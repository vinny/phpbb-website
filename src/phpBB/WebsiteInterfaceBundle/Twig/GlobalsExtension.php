<?php
/**
 *
 * @package phpBBWebsiteInterfaceBundle
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace phpBB\WebsiteInterfaceBundle\Twig;

class GlobalsExtension extends \Twig_Extension
{
	public function getGlobals()
	{
		$generalVars = array(
			'package_version'		=> '3.0.11', // Usage = 1
			'package_release_date'	=> '2012-08-25', // Usage = 1
			'bot'					=> false, // @TODO Set this to true for bots
			'LISTS_SUBSCRIBE'		=> 'http://lists.phpbb.com/mailman/subscribe/phpbb-announce', // Usage = 1
		);

		// @TODO Generate URLs for routes
		$pathVars = $this->getMainPaths();

		$modVars = $this->getModsVars();

		$supportVars = $this->getSupportVars();

		$peopleVars = $this->getPeopleVars();

		$developmentVars = array(
			'DEV_HOME' => '//area51.phpbb.com/',
			'DEV_BOARD' => '//area51.phpbb.com/phpBB/',
			'BUGS_PHPBB' => 'http://tracker.phpbb.com/', // Usage = 2
			'BUGS' => '/bugs/',
			'SECURITY' => '/security/', // Usage = 2
			'DEV_PROSILVER' => '/development/prosilver/', // Usage = 2
			'INCIDENTS' => '/incidents/',
		);

		$aboutVars = array(
			'ABOUT_FEATURES'	=> '/about/features/',
			'ABOUT_COMPARE'		=> '/about/features/compare.php',
			'ABOUT_HISTORY'		=> '/about/history/',
			'ABOUT_TEAM'		=> '/about/team/',
			'ABOUT_MAP'			=> '/about/map/',
			'ABOUT_LOGOS'		=> '/about/logos/',
			'ABOUT_CONTACT'		=> '/about/contact_us.php',
			'ABOUT_ADVERTISE'	=> '/about/advertise/',
			'STYLES_JV_APP'		=> '/styles/contribute/index.php?p=jv',
			'LANGUAGES_30X'		=> '/languages/',
			'MANAGEMENT_TEAM'	=> '/community/memberlist.php?mode=group&g=13330',
		);

		$forumVars = array(
			'FORUM_PHPBBDISC' 	=> '/community/viewforum.php?f=64',
			'RULES'				=> '/rules/',
			);

		$variables = array_merge(
			$generalVars,
			$pathVars,
			$modVars,
			$developmentVars,
			$supportVars,
			$aboutVars,
			$peopleVars,
			$forumVars
		);

		return $variables;
	}

	public function getName()
	{
		return 'phpbb_extension_globals';
	}

	private function getMainPaths()
	{
		$pathVars = array(
			'home_path'			=> '/',
			'about_path'		=> '/about/',
			'advertise_path'	=> '/about/advertise/',
			'demo_path'			=> '/demo/',
			'downloads_path'	=> '/downloads/',
			'cdb_path'			=> '/customise/db/',
			'support_path'		=> '/support/',
			'development_path'	=> '/development/', // Usage = 3
			'community_path'	=> '/community/',
			'contact_path'		=> '/about/contact_us.php',
			'get_involved_path'	=> '/get-involved/', // Usage = 2
			'mods_db_path'		=> '/customise/db/modifications-1/',
			'mods_path'			=> '/mods/',
			'styles_db_path'	=> '/customise/db/styles-2/',
			'shop_path'			=> '/shop/',
			'blog_link'			=> '//blog.phpbb.com/',
			'feeds_rss_path'	=> '/feeds/rss/',
			'kb_path'			=> '/kb/',
			'showcase_path'		=> '/showcase/',
			'documentation_path'=> '/support/documentation/',
			'ideas_path'		=> '/ideas/',
		);

		return $pathVars;
	}

	private function getSupportVars()
	{
		$supportVars = array(
			'DOCUMENTATION_3_0' 		=> '/support/documentation/3.0/',
			'SUPPORT_TUTORIALS_3_0' 	=> '/upport/tutorials/3.0/',
			'SUPPORT_IRC'				=> '/support/irc/',
			'SUPPORT_SRT' 				=> '/support/srt/',
			'SUPPORT_FORUMS'			=> '/support/forums/',
			'SUPPORT_INTL'				=> '/support/intl/',
			'SUPPORT_STK'				=> '/support/stk/',
			'SUPPORT_TUTORIALS'			=> '/support/tutorials/',
			'SUPPORT_CODE_CHANGES'		=> '//area51.phpbb.com/code-changes/',
		);

		return $supportVars;
	}

	private function getModsVars()
	{
		$modVars = array(
			'MODS_POLICY' => '/mods/rules-and-policies/',
			'FORUM_MODS_30X' =>'/community/viewforum.php?f=81',
			'MODS_MODX' => '/mods/modx/',
			'MODS_TEAM_OVERVIEW' => '/mods/team-overview/',
			'MODS_AUTOMOD' => '/mods/automod/',
			'MODS_UMIL' => '/mods/umil/',
			'MODS_TRACKER' => '/bugs/modteamtools/',
			'MODS_AUTHOR_INTRO' => '/mods/author-introduction/',
			'MODS_MPV' => '/mods/mpv/',
			'MODS_MODX_TOOLS' => '/mods/modx-tools/',
			'MODS_UMIL_CREATOR' => '/mods/umil/create.',
			'MODS_QUICKINSTALL' => '/mods/quickinstall/',
			'MODS_RULES_AND_POLICIES' => '/mods/rules-and-policies/',
			'MODS_GUIDELINES' => '//area51.phpbb.com/docs/30x/coding-guidelines.html',
			'DEV_WIKI' => '//wiki.phpbb.com/',
			'MODS_FINDING' => '/mods/finding/',
			'MODS_OPENING' => '/mods/opening/',
			'MODS_INSTALLING' => '/mods/installing/',
			'MODS_SUPPORT' => '/mods/support/',
			'BRIDGES_POLICIES' => '/mods/bridges/',
			'BRIDGES_DB' => '/customise/db/bridges-24/',
			'MODS_FAQ' => '/mods/faq/',
			'MODS_TEAM_OVERVIEW_JR' => '/mods/team-overview/?p=jr', // Usage = 2
		);

		return $modVars;
	}

	private function getPeopleVars()
	{
		$peopleVars = array(
			'SUPPORT_TL_NAME'		=> 'Noxwizard',
			'SUPPORT_TL_CONTACT'	=> '/community/memberlist.php?mode=viewprofile&u=192443',
			'SUPPORT_DOCS_NAME'		=> 'stevemaury',
			'SUPPORT_DOCS_CONTACT'	=> '/community/memberlist.php?mode=viewprofile&u=280664',
			'STYLES_TL_NAME'		=> 'Raimon',
			'STYLES_TL_CONTACT'		=> '/community/memberlist.php?mode=viewprofile&u=253197',
			'WEBSITE_TL_NAME'		=> 'Marshalrusty',
			'WEBSITE_TL_CONTACT'	=> '/community/memberlist.php?mode=viewprofile&u=151944',
		);

		return $peopleVars;
	}
}
