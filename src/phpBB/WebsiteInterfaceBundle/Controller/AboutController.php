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

class AboutController extends Controller
{
	public function homeAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'about',
		);

		return $this->render('phpBBWebsiteInterfaceBundle:About:home.html.twig', $templateVariables);
	}

	public function historyAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'about history',
		);

		return $this->render('phpBBWebsiteInterfaceBundle:About:history.html.twig', $templateVariables);
	}

	public function advertiseAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'about advertise-contact',
		);

		return $this->render('phpBBWebsiteInterfaceBundle:About:advertise.html.twig', $templateVariables);
	}
}
