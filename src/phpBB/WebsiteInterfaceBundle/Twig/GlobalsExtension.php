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
			'package_version'		=> '3.0.11',
			'package_release_date'	=> '2012-08-25',
			'bot'					=> false, // TODO: Set this to true for bots
		);

		$pathVars = array(
			'home_path'			=> '/',
			'about_path'		=> '/about/',
			'advertise_path'	=> '/about/advertise/',
			'demo_path'			=> '/demo/',
			'downloads_path'	=> '/downloads/',
			'cdb_path'			=> '/customise/db/',
			'support_path'		=> '/support/',
			'development_path'	=> '/development/',
			'community_path'	=> '/community/',
			'contact_path'		=> '/about/contact_us.php',
			'get_involved_path'	=> '/get-involved/',
			'mods_db_path'		=> '/customise/db/modifications-1/',
			'mods_path'			=> '/mods/',
			'styles_db_path'	=> '/customise/db/styles-2/',
			'shop_path'			=> '/shop/',
			'blog_link'			=> '//blog.phpbb.com/',
			'feeds_rss_path'	=> '/feeds/rss/',
		);

		$modVars = array(

		);

		$variables = array_merge(
			$generalVars,
			$pathVars,
			$modVars);

		return $variables;
	}

	public function getName()
	{
		return 'phpbb_extension_globals';
	}
}
