<?php
/**
 *
 * @package PhpbbWebsiteInterfaceBundle
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace Phpbb\WebsiteInterfaceBundle\Controller;

use Phpbb\WebsiteInterfaceBundle\Wrappers\PhpbbHandling;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GlobalController extends Controller
{
	public function homeAction()
	{
		$templateVariables = array();
		$announcement_forum = 14;

		$finishedAnnouncements = $this->getForumAnnouncements($announcement_forum);

		// Get announcements file
		$blogFile = @file_get_contents('https://www.phpbb.com/website/wp_announcements.php?password=thisisnotverysecretbutitdoesntreallyneedtobe');

		$blogJson = @json_decode($blogFile, true);

		$blogAnnouncements = $blogJson === null ? array() : $blogJson;

		krsort($blogAnnouncements);

		$announcements = array_merge($finishedAnnouncements, $blogAnnouncements);

		$templateVariables += array(
			'homepage'              => true,
			'announcements_forum'   => '/community/viewforum.php?f=' . $announcement_forum,
			'announcements'         => $announcements,
			'header_css_image'      => 'home',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Global:index.html.twig', $templateVariables);
	}

	public function demoAction()
	{
		$templateVariables = array(
			'header_css_image'      => 'demo',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Global:demo.html.twig', $templateVariables);
	}

	public function customiseAction()
	{
		$templateVariables = array(
			'header_css_image'      => 'customise',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Global:customise.html.twig', $templateVariables);
	}

	public function updateAction($action = 'home', $resultId = 0)
	{
		$authorised = false;

		$root_path = '../../../../../';

		$last_pull_time = filemtime($root_path . '.git/HEAD');
		$revision_hash = trim(file_get_contents($root_path . '.git/HEAD'));

		if (substr($revision_hash, 0, 5) === 'ref: ')
		{
			$last_pull_time = filemtime($root_path . '.git/' . substr($revision_hash, 5));
			$revision_hash = trim(file_get_contents($root_path . '.git/' . substr($revision_hash, 5)));
		}

		// The people who can use this script. Ask your TL for permission if you need it!
		$groups = array(
			4,		// Management Team
			7331,	// Development Team
			13330,	// MOD Team
			47077,	// Website Team
		);

		$users = array(
			987265, // Oyabun1
		);

		if ((count(array_diff($groups, $user->data['groups'])) < 4) || in_array($user->data['id'], $users))
		{
			$authorised = true;
		}

		$templateVariables = array(
			'header_css_image'      => 'home',
			'revision_hash'			=> $revision_hash,
			'last_pull_time'		=> date('l jS \of F Y \a\t h:i:s A', $last_pull_time),
		);

		switch ($action) {
			case 'update':
				$templateVariables += array(
					'show_progress' => true,
				);

				if (file_exists($root_path . 'app/updates/.update_result'))
				{
					unlink($root_path . 'app/updates/.update_result');
				}

				// Create update file...
				$fp = fopen($root_path . 'app/cache/.update', 'wb');
				fwrite($fp, 'Website Update Initiated By ' . $user->data['username'] . "\n");
				fclose($fp);

				$result = time() - 10;
				break;

			case 'result':
				if (!$resultId)
				{
					$this->createNotFoundException('You should have a result id if you want to get a result');
				}

				$success = false;

				if (file_exists($root_path . 'app/cache/.update_result'))
				{
					$filetime = filemtime($root_path . 'app/cache/.update_result');

					if ($filetime >= $result)
					{
						$success = true;
						$contents = nl2br(htmlspecialchars(file_get_contents($root_path . 'app/cache/.update_result')));
						$contents_no_break = htmlspecialchars(file_get_contents($root_path . 'app/cache/.update_result'));
						$response = '';

						$fp = fopen($root_path . 'app/updates/'. $resultId, 'wb');
						fwrite($fp, file_get_contents($root_path . 'app/cache/.update_result'));
						fclose($fp);

						$update_file_count = 0;
					    $dir = $root_path . 'app/updates/';
					    if ($handle = opendir($dir)) {
					        while (($file = readdir($handle)) !== false){
					            if (!in_array($file, array('.', '..')) && !is_dir($dir.$file))
					                $update_file_count++;
					        }
					    }

						$template->assign_vars(array(
							'show_result'	=> true,
							'result'		=> $contents . '<br />' . $response,
						));

						// Send an email to the website team with the output of the update script.
						$message = \Swift_Message::newInstance()
							->setSubject('Website Update Script Run')
							->setFrom(array('website-update@phpbb.com' => 'phpBB Contact'))
							->setTo(array('website@phpbb.com' => 'phpBB Website Team'))
							->setReturnPath('website@phpbb.com')
							->setBody(
								$this->renderView(
									'PhpbbWebsiteInterfaceBundle:Global:websiteUpdate.email.twig',
									array(
										'result' 		=> $contents_no_break . $response,
										'result_id'		=> $resultId,
										'update_file_count'	=> $update_file_count,
										'update_time'	=> date('l jS \of F Y \a\t h:i:s A', $last_pull_time),
									),
								)
							)
						;
						$this->get('mailer')->send($message);
					}
				}

				if (!$success)
				{
					$templateVariables += array(
						'show_progress' => true,
					);
					meta_refresh(10, '/update_website/result/'. $resultId);
				}

				break;
		}

		return $this->render('PhpbbWebsiteInterfaceBundle:Global:update.html.twig', $templateVariables);
	}

	/**
	 * @param integer $announcement_forum
	 */
	private function getForumAnnouncements($announcement_forum)
	{
		$retrieve_limit = 3;

		$phpbbConnection = $this->get('doctrine.dbal.phpbb_connection');
		$forumAnnouncements = PhpbbHandling::getTopicsFromForum($phpbbConnection, $announcement_forum, $retrieve_limit);
		$finishedAnnouncements = array();

		foreach ($forumAnnouncements as $announcement) {
			$preview = $announcement['post_text'];
			$preview = PhpbbHandling::bbcodeStripping($preview, $announcement['bbcode_uid']);
			$preview = preg_replace('#http(?:\:|&\#58;)//\S+#', '', $preview);

			// Decide how large the preview text should be
			$preview_max_len = 200;
			$preview_len = strlen($preview);

			if ($preview_len > $preview_max_len) {
				// Truncate to the maximum length
				$preview = substr($preview, 0, $preview_max_len);

				// See if there is a nice place to break close to the max length
				$breakchars = array(' ', ',', '.');
				$clean_break_pos = 0;

				foreach ($breakchars as $char) {
					$clean_break_pos_new = strrpos($preview, $char);
					$clean_break_pos = $clean_break_pos_new > $clean_break_pos ? $clean_break_pos_new : $clean_break_pos;
				}

				if ($clean_break_pos) {
					$preview = substr($preview, 0, $clean_break_pos);
				}
			}

			$finishedAnnouncements[$announcement['topic_time']] = array(
				'DAY' => date('d', $announcement['topic_time']),
				'MONTH' => date('M', $announcement['topic_time']),
				'YEAR' => date('Y', $announcement['topic_time']),
				'U_LINK' => '/community/viewtopic.php?f=' . $announcement_forum . '&amp;t=' . $announcement['topic_id'],
				'TITLE' => $announcement['topic_title'],
				'FROM_BLOG' => false,
				'PREVIEW' => $preview,
			);
		}

		return $finishedAnnouncements;
	}
}
