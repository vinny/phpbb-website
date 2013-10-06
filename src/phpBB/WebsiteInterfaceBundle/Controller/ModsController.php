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

class ModsController extends Controller
{
    public function homeAction()
    {
        $templateVariables = array(
            'header_css_image'		=> 'mods',
        );

        return $this->render('PhpbbWebsiteInterfaceBundle:Mods:home.html.twig', $templateVariables);
    }
}
