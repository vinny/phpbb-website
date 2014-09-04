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
     * @param Doctrine\DBAL\Connection      $phpBBConnection    DBAL connection to a phpBB database
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



	public static function getStyleValidationStatistics(\Doctrine\DBAL\Connection $phpbbConnection, $database_prefix = 'phpbb_', $customisation_prefix = 'customisation_', $group_ids, $access_group_ids, $month_sel, $year_sel)
	{
		// TODO: there's probably a better way than define()
		define('GROUPS_TABLE', $database_prefix . 'groups');
		define('USER_GROUP_TABLE', $database_prefix . 'user_group');
		define('USERS_TABLE', $database_prefix . 'users');
		define('CUSTOM_POSTS_TABLE', $customisation_prefix . 'posts');
		define('CUSTOM_TOPICS_TABLE', $customisation_prefix . 'topics');
		define('CUSTOM_QUEUE_TABLE', $customisation_prefix . 'queue');
		define('CUSTOM_CONTRIBS_TABLE', $customisation_prefix . 'contribs');
		$contrib_url_prefix = '../customise/db/';

		// Only the Styles Team, Dev Team and Management Team/Administrators have access TODO
		/*if (!$user->data['is_registered'] || !group_memberships($access_group_ids, $user->data['user_id'], true))
		{
			trigger_error('You are not authorized to view this page.');
		}*/

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
					'team' => ($user['group_id'] == $group_ids['styles_team_id']) ? 1 : 0 // 1 = styles team, 0 = jr team
				);
			}
		}

		// Let's get some stats
		$sql = "SELECT cp.post_user_id, cc.contrib_name, cp.post_time, cp.post_url, cp.post_id
		FROM " . CUSTOM_POSTS_TABLE . " cp
		JOIN " . CUSTOM_TOPICS_TABLE . " ct ON ct.topic_id = cp.topic_id
		JOIN " . CUSTOM_QUEUE_TABLE . " cq ON cq.queue_topic_id = ct.topic_id
		JOIN " . CUSTOM_CONTRIBS_TABLE . " cc ON cc.contrib_id = cq.contrib_id
		WHERE
			ct.topic_type = 3 AND ct.topic_category = 2 AND
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
						'url'        => $contrib_url_prefix . $contrib['post_url'] . "-p_{$contrib['post_id']}#p{$contrib['post_id']}",
						'time_added' => '1-1-1970',
						//'time_added' => $user->format_date($contrib['post_time']), // TODO
					);
				}
			}
		}

		return $stats;
	}
}
