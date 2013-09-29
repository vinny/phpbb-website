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

class SupportController extends Controller
{
	public function homeAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'support',
		);

		return $this->render('phpBBWebsiteInterfaceBundle:Support:home.html.twig', $templateVariables);
	}

	public function ircAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'support irc',
		);

		return $this->render('phpBBWebsiteInterfaceBundle:Support:irc.html.twig', $templateVariables);
	}
}
