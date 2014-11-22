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

class SupportController extends Controller
{
    public function homeAction()
    {
        return $this->render('PhpbbWebsiteInterfaceBundle:Support:home.html.twig');
    }

    public function ircAction()
    {
        return $this->render('PhpbbWebsiteInterfaceBundle:Support:irc.html.twig');
    }
}
