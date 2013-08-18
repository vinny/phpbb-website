<?php
/**
 *
 * @package phpBBWebsiteInterfaceBundle
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace phpBB\WebsiteInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GlobalController extends Controller
{
	public function homeAction()
	{
		// Should the Announcements forum ever obtain a new forum_id, *CHANGE THIS VARIABLE*.
		$announcement_forum = 14;
		$retrieve_limit = 3;

		$sql = 'SELECT t.*, p.post_text, p.bbcode_uid
			FROM community_topics t
			LEFT JOIN community_posts p
				ON t.topic_first_post_id = p.post_id
			WHERE t.forum_id IN (' . $announcement_forum . ', 0)
				AND t.topic_approved = 1
			ORDER BY topic_time DESC
			LIMIT 0,' . $retrieve_limit;

		$phpbbConnection = $this->get('doctrine.dbal.phpbb_connection');
		$announcements = $phpbbConnection->fetchAll($sql);

		foreach ($announcements as $announcement)
		{
			//bbcodeStripping($text)
		}

		$templateVariables = array(
			'homepage'				=> true,
			'announcements_forum'	=> '/community/viewforum.php?f=' . $announcement_forum,
		);

		return $this->render('phpBBWebsiteInterfaceBundle:Global:index.html.twig', $templateVariables);
	}
}
