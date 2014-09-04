<?php
/**
 *
 * @package PhpbbWebsiteInterfaceBundle
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace Phpbb\WebsiteInterfaceBundle\Wrappers;

class PhpbbHandling
{
    /**
     * Strip bbcodes from a post content
     *
     * @param  string $text The raw content from the database to strip bbcodes from
     * @param  string $uid  The $uid used in encoding/decoding the bbcode
     * @return string $text The post with bbcodes stripped
     * @access public
     * @static
     */
    public static function bbcodeStripping($text, $uid = '[0-9a-z]{5,}')
    {
        $text = preg_replace("#\[\/?[a-z0-9\*\+\-]+(?:=(?:&quot;.*&quot;|[^\]]*))?(?::[a-z])?(\:$uid)\]#", ' ', $text);
        $match = array(
            '#<!\-\- e \-\-><a href="mailto:(.*?)">.*?</a><!\-\- e \-\->#',
            '#<!\-\- l \-\-><a (?:class="[\w-]+" )?href="(.*?)(?:(&amp;|\?)sid=[0-9a-f]{32})?">.*?</a><!\-\- l \-\->#',
            '#<!\-\- ([mw]) \-\-><a (?:class="[\w-]+" )?href="(.*?)">.*?</a><!\-\- \1 \-\->#',
            '#<!\-\- s(.*?) \-\-><img src="\{SMILIES_PATH\}\/.*? \/><!\-\- s\1 \-\->#',
            '#<!\-\- .*? \-\->#s',
            '#<.*?>#s',
        );
        $replace = array('\1', '\1', '\2', '\1', '', '');

        $text = preg_replace($match, $replace, $text);

        return $text;
    }

    /**
     * Get the topic details from the forums table & the first post
     *
     * @param \Doctrine\DBAL\Connection      $phpBBConnection    DBAL connection to a phpBB database
     *                                                              (Doctrine\DBAL\Connection)
     * @param integer $forum                ID for the forum to get topics from
     * @param integer $retrieve_limit       Maxmium number of topics to retrieved
     * @param string  $database_prefix      The prefix of the tables in the database (include underscore)
     * @return array  $topics               The topics from that forum
     * @access public
     * @static
     */
    public static function getTopicsFromForum(\Doctrine\DBAL\Connection $phpbbConnection, $forum, $retrieve_limit, $database_prefix = 'phpbb_')
    {
        $sql = 'SELECT t.*, p.post_text, p.bbcode_uid
            FROM ' . $database_prefix . 'topics t
            LEFT JOIN ' . $database_prefix . 'posts p
                ON t.topic_first_post_id = p.post_id
            WHERE t.forum_id IN (' . $forum . ', 0)
                AND t.topic_visibility = 1
            ORDER BY topic_time DESC
            LIMIT 0,' . $retrieve_limit;

        $topics = $phpbbConnection->fetchAll($sql);

        return $topics;
    }

	/**
	 * Generate a statistics array for a specific month/year, containing all contributions of group's members.
	 *
	 * @param \Doctrine\DBAL\Connection $phpbbConnection DBAL connection to a phpBB database
	 * @param string                    $database_prefix
	 * @param string                    $cdb_prefix
	 * @param int                       $type            Titania category type (1 = mod, 2 = style, etc.)
	 * @param array                     $group_ids       The groups which should be used for statistics
	 * @param int                       $month_sel       The selected month for the statistics query
	 * @param int                       $year_sel        The selected year for the statistics query
	 * @return array                    $stats
	 */
	public static function getValidationStatistics(\Doctrine\DBAL\Connection $phpbbConnection, $database_prefix = 'phpbb_', $cdb_prefix = 'customisation_', $type = 1, $group_ids, $month_sel, $year_sel)
	{
		// TODO: there's probably a better way than define()
		define('GROUPS_TABLE', $database_prefix . 'groups');
		define('USER_GROUP_TABLE', $database_prefix . 'user_group');
		define('USERS_TABLE', $database_prefix . 'users');
		define('CDB_POSTS_TABLE', $cdb_prefix . 'posts');
		define('CDB_TOPICS_TABLE', $cdb_prefix . 'topics');
		define('CDB_QUEUE_TABLE', $cdb_prefix . 'queue');
		define('CDB_CONTRIBS_TABLE', $cdb_prefix . 'contribs');

		$stats = $user_stats = array();

		// Get list of users
		$sql = 'SELECT u.user_id, u.username, ug.group_id
		FROM ' . USERS_TABLE . ' u
		JOIN ' . USER_GROUP_TABLE . ' ug ON ug.user_id = u.user_id
		WHERE ug.group_id IN (' . implode(', ', $group_ids) . ')
		ORDER BY ug.group_id, u.username';
		$users = $phpbbConnection->fetchAll($sql);

		foreach ($users as $user)
		{
			$user_id = $user['user_id'];

			if (!isset($stats[$user_id])) {
				$stats[$user_id] = array(
					'username' => $user['username'],
					'team' => ($user['group_id'] == $group_ids[0]) ? 1 : 0 // 1 = primary, 0 = secondary
				);
			}
		}

		// Let's get some stats
		$sql = "SELECT cp.post_user_id, cc.contrib_name, cp.post_time, cp.post_url, cp.post_id
		FROM " . CDB_POSTS_TABLE . " cp
		JOIN " . CDB_TOPICS_TABLE . " ct ON ct.topic_id = cp.topic_id
		JOIN " . CDB_QUEUE_TABLE . " cq ON cq.queue_topic_id = ct.topic_id
		JOIN " . CDB_CONTRIBS_TABLE . " cc ON cc.contrib_id = cq.contrib_id
		WHERE
			ct.topic_type = 3 AND ct.topic_category = " . $type . " AND
			FROM_UNIXTIME(cp.post_time, '%m') = '" . str_pad($month_sel, 2, "0", STR_PAD_LEFT) . "' AND
			FROM_UNIXTIME(cp.post_time, '%Y') = $year_sel AND
			(LOWER(post_text) LIKE 'moved from % to %' OR LOWER(post_text) = 'marked as in-progress')
		GROUP BY cc.contrib_id, cp.post_user_id
		ORDER BY cc.contrib_name";
		$result = $phpbbConnection->fetchAll($sql);

		foreach ($result as $row)
		{
			$user_stats[$row['post_user_id']][] = $row;
		}

		// Make one big array with all the members and their contributions
		foreach ($stats as $user_id)
		{
			$stats[$user_id]['total_month'] = (isset($user_stats[$user_id]) ? count($user_stats[$user_id]) : 0);

			if (isset($user_stats[$user_id]))
			{
				foreach ($user_stats[$user_id] as $contrib)
				{
					$stats[$user_id]['contribs'][] = array(
						'name'       => $contrib['contrib_name'],
						'url'        => $contrib['post_url'] . "-p_{$contrib['post_id']}#p{$contrib['post_id']}",
						'time_added' => '1-1-1970',
						//'time_added' => $user->format_date($contrib['post_time']), // TODO
					);
				}
			}
		}

		return $stats;
	}

	/**
	 * Shared function which returns HTML formatted option lists for date selection forms.
	 * It also converts the selected month from an (int) to a name (string)
	 *
	 * @param $month_sel
	 * @param $month_list
	 * @param $year_sel
	 * @param $year_list
	 */
	public static function getDateFormLists(&$month_sel, &$month_list, &$year_sel, &$year_list)
	{
		$month_list = $year_list = '';

		$months = array(
			1  => 'January',
			2  => 'February',
			3  => 'March',
			4  => 'April',
			5  => 'May',
			6  => 'June',
			7  => 'July',
			8  => 'August',
			9  => 'September',
			10 => 'October',
			11 => 'November',
			12 => 'December'
		);

		foreach ($months as $month_num => $month_name)
		{
			$month_list .= '<option value="' . $month_num . '"' . (($month_num == $month_sel) ? ' selected="selected"' : '') . '>' . $month_name . '</option>';
		}

		// We start at 2010 since that's when Titania went live
		for ($year_start = 2010; $year_start <= (int)date("Y"); $year_start++)
		{
			$year_list .= '<option value="' . $year_start . '"' . (($year_start == $year_sel) ? ' selected="selected"' : '') . '>' . $year_start . '</option>';
		}

		$month_sel = $months[$month_sel];
	}
}
