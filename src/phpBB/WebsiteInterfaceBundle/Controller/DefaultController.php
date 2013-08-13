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

class DefaultController extends Controller
{
    public function homeAction()
    {
    	$templateVariables = array(
    		'bot' => false,
    		'homepage'	=> true,
    	);

        return $this->render('phpBBWebsiteInterfaceBundle:Default:index.html.twig', $templateVariables);
    }
}
