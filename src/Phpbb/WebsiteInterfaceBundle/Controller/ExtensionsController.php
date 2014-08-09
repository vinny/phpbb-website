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

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Phpbb\WebsiteInterfaceBundle\Helper\Extensions\OfficialExtension;

// Controller for Extensions pages
class ExtensionsController extends Controller
{
	public function homeAction()
	{
		// Extensions Homepage
		$templateVariables = array(
			'header_css_image' => 'mods',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Extensions:home.html.twig', $templateVariables);
	}

	public function recognisedDeveloperAction()
	{
		$templateVariables = array(
			'header_css_image' => 'mods',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Extensions:recognised-developer.html.twig', $templateVariables);
	}

	public function officialExtensionsAction()
	{
		// TODO: In the future we may load this dynamically from a database table
		$officialExtensions = array();

		$officialExtensions[] = new OfficialExtension(
			'Board Rules Extension',
			'The Board Rules Extension adds a dedicated Rules page to a board. It offers an ACP module from which an unlimited number of rules and rule categories can be created in each language installed on a board. It also supports sending out notifications to all board members notifying them that the rules have been changed, and can require newly registering users read the board rules as part of the terms of agreement for registering on a board.',
			'The Board Rules Extension is a fairly advanced design compared to previous phpBB modifications. Unique classes implemented through interfaces are used to specify the methods that handle most of the code logic. There is an Entity class for manipulating a single rule and an Operator class for manipulating sets of rules. Controller classes are used to process the front-end of the ACP module and the Rules page itself. It also makes use of phpBB\'s new notification system, nestedsets/trees, and AJAX functionality in the ACP user-interface. There is also extensive PHP unit test coverage of the code to ensure its stability and reliability and prevent regressions. We think testing code is so important, we\'ve made it possible to use phpBB\'s PHPUnit testing framework with Travis Continuous Integration hosted servers; just look through our tests folder to see how we did it.',
			'https://www.phpbb.com/community/viewtopic.php?f=456&t=2208976',
			'https://github.com/phpbb-extensions/boardrules'
		);

		$officialExtensions[] = new OfficialExtension(
			'Board Announcements Extension',
			'The Board Announcements Extension allows board admins to create a special board-wide announcement. Unlike phpBB\'s native global announcements which only appear inside forums, Board Announcements appear near the top of any page being viewed. Users have the option to dismiss the announcement after they have read it.',
			'Board Announcements is an entry-level extension by design. We built this extension using techniques that will be more familiar to MOD developers. Code changes are injected directly from the event listener, and all ACP module logic is contained in its ACP module class. Overall, this extension is a good example that shows how to inject new code, add an ACP module, utilize a controller file to run some functional code in combination with AJAX, and how to use phpBB\'s new config_text table to store textual data.',
			'https://www.phpbb.com/community/viewtopic.php?f=456&t=2245901',
			'https://github.com/phpbb-extensions/boardannouncements'
		);

		$officialExtensions[] = new OfficialExtension(
			'Google Analytics Extension',
			'The Google Analytics Extension simply adds a Google Analytics tracking code with your Property ID to your phpBB forum.',
			'This extension is the simplest of extensions in form and function. It adds a single new field to the ACP for a Google Analytics Property ID, validates it, and inserts the tracking code into the head of your board\'s HTML pages, just before the closing </head> tag, as recommended by Google.',
			'In addition to allowing boards to easily add Google\'s powerful analytics, this extension is an ideal starting example for new extension authors, showing how to effectively add an ACP config option and add some simple code implementing that config setting using template events.',
			'https://www.phpbb.com/community/viewtopic.php?f=456&t=2249256',
			'https://github.com/phpbb-extensions/googleanalytics'
		);

		$templateVariables = array(
			'header_css_image'  => 'mods',
			'extensions'		=> $officialExtensions,
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Extensions:official-extensions.html.twig', $templateVariables);
	}

	public function officialExtensionsTeamAction()
	{
		$templateVariables = array(
			'header_css_image' => 'mods',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Extensions:official-extensions-team.html.twig', $templateVariables);
	}

	public function installingAction()
	{
		$templateVariables = array(
			'header_css_image' => 'mods',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Extensions:installing.html.twig', $templateVariables);
	}

	public function writingAction()
	{
		$templateVariables = array(
			'header_css_image' => 'mods',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Extensions:writing.html.twig', $templateVariables);
	}

	public function teamOverviewAction()
	{
		$templateVariables = array(
			'header_css_image' => 'mods',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Extensions:team-overview.html.twig', $templateVariables);
	}

	public function devRulesAction()
	{
		// Extensions Rules and Guidelines
		$templateVariables = array(
			'header_css_image' => 'mods',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Extensions:ext_dev_rules.html.twig', $templateVariables);
	}

	public function rulesAction()
	{
		// Extensions Rules and Guidelines
		$templateVariables = array(
			'header_css_image' => 'mods',
			'policies'		 => array(
				array('name' => 'Repack Policy', 'description' => 'How we handle repacking of Extensions.', 'link' => '/extensions/rules-and-guidelines/repack'),
				array('name' => 'Insta Deny Policy', 'description' => 'How we handle Insta Denies of Extensions.', 'link' => '/extensions/rules-and-guidelines/insta-deny'),
				array('name' => 'General', 'description' => 'Some general policies on how we handle validation.', 'link' => '/extensions/rules-and-guidelines/general'),
				//array('name' => 'Validation checklist', 'description' => 'A reference for Extensions Authors to improve the validation process for their Extensions.', 'link' => '/extensions/rules-and-guidelines/checklist'),
			)
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Extensions:rules.html.twig', $templateVariables);
	}

	public function repack()
	{
		// Extensions Rules and Guidelines
		$templateVariables = array(
			'header_css_image' => 'mods',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Extensions:repack.html.twig', $templateVariables);
	}

	public function instadenyAction()
	{
		// Extensions Rules and Guidelines
		$templateVariables = array(
			'header_css_image' => 'mods',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Extensions:insta_deny.html.twig', $templateVariables);
	}

	public function generalAction()
	{
		// Extensions Rules and Guidelines
		$templateVariables = array(
			'header_css_image' => 'mods',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Extensions:general.html.twig', $templateVariables);
	}

	public function checklistAction()
	{
		// Extensions Rules and Guidelines
		$templateVariables = array(
			'header_css_image' => 'mods',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Extensions:checklist.html.twig', $templateVariables);
	}
}
