<?php
/**
 * 
 * @package phpBBWebsiteInterfaceBundle
 * @copyright (c) 2012 phpBB Group
 * @license http://opensource.org/licenses/gpl-3.0.php GNU General Public License v3
 * @author Unknown Bliss
 * 
 */

namespace phpBB\WebsiteInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function homeAction()
    {
        return $this->render('phpBBWebsiteInterfaceBundle:Default:index.html.twig');
    }
}
