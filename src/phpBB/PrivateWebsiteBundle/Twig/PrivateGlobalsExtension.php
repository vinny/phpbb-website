<?php
/**
 *
 * @package phpBBPrivateWebsiteBundle
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author MichaelC
 *
 */

namespace phpBB\WebsiteInterfaceBundle\Twig;

class PrivateGlobalsExtension extends \Twig_Extension
{
	public function getGlobals()
	{
		$variables = array(
			'FORUM_PRIVATE'				=> '/community/viewforum.php?f=53',
			'SUPPORT_COOKIES'			=> '/support/cookies.php',
		);

		return $variables;
	}

	public function getName()
	{
		return 'phpbb_extension_private_globals';
	}
}
