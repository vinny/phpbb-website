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
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:Extensions:rules.html.twig', $templateVariables);
    }
}
