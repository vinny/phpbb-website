<?php
/**
 *
 * @package PhpbbWebsiteInterfaceBundle
 * @copyright (c) 2014 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author PayBas
 *
 */

namespace Phpbb\WebsiteInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StylesController extends Controller
{
    public function homeAction()
    {
        $templateVariables = array(
            'header_css_image'		=> 'styles',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:Styles:home.html.twig', $templateVariables);
    }

    public function faqAction()
    {
        $templateVariables = array(
            'header_css_image'		=> 'styles faq',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:Styles:faq.html.twig', $templateVariables);
    }

    public function contributeAction()
    {
        $templateVariables = array(
            'header_css_image'		=> 'styles contribute',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:Styles:contribute.html.twig', $templateVariables);
    }

	public function sspAction()
	{
		$templateVariables = array(
			'header_css_image'		=> 'styles ssp',
		);

		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:ssp.html.twig', $templateVariables);
	}
}
