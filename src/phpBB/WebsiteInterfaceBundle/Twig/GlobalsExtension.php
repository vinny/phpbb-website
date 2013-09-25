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
            'get_involved_path'	=> '/get-involved/',
            'mods_db_path'		=> '/customise/db/modifications-1/',
            'mods_path'			=> '/mods/',
            'styles_db_path'	=> '/customise/db/styles-2/',
            'shop_path'			=> '/shop/',
            'blog_link'			=> '//blog.phpbb.com/',
            'feeds_rss_path'	=> '/feeds/rss/',
            'kb_path'			=> '/kb/',
            'showcase_path'		=> '/showcase/',
            'documentation_path'=> '/support/documentation/',
        );

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
            'MODS_TEAM_OVERVIEW_JR' => '/mods/team-overview/?p=jr',
        );

        $developmentVars = array(
            'DEV_HOME' => '//area51.phpbb.com/',
            'DEV_BOARD' => '//area51.phpbb.com/phpBB/',
            'BUGS_PHPBB' => 'http://tracker.phpbb.com/',
            'BUGS' => '/bugs/',
            'SECURITY' => '/security/',
            'DEV_PROSILVER' => '/development/prosilver/', // Usage = 2
        );

        $supportVars = array(
            'SUPPORT_TUTORIALS' => '/support/tutorials/',
        );

        $aboutVars = array(
            'ABOUT_FEATURES' => '/about/features/',
            'ABOUT_COMPARE' => '/about/features/compare.php',
            'ABOUT_HISTORY' => '/about/history/',
            'ABOUT_TEAM' => '/about/team/',
            'ABOUT_MAP' => '/about/map/',
            'ABOUT_LOGOS' => '/about/logos/',
            'ABOUT_CONTACT' => '/about/contact_us.php',
            'ABOUT_ADVERTISE' => '/about/advertise/',
        );

        $variables = array_merge(
            $generalVars,
            $pathVars,
            $modVars,
            $developmentVars,
            $supportVars,
            $aboutVars
        );

        return $variables;
    }

    public function getName()
    {
        return 'phpbb_extension_globals';
    }
}
