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
        return $this->render('PhpbbWebsiteInterfaceBundle:Styles:home.html.twig');
    }

	public function supportAction()
	{
		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:support.html.twig');
	}

	public function installingAction()
	{
		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:installing.html.twig');
	}

	public function createAction()
	{
		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:create.html.twig');
	}

    public function teamOverviewAction()
    {
        return $this->render('PhpbbWebsiteInterfaceBundle:Styles:team-overview.html.twig');
    }

	public function juniorValidatorsAction()
	{
		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:junior-validators.html.twig');
	}

	public function sspAction()
	{
		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:ssp.html.twig');
	}

	public function ssp30xAction()
	{
		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:ssp-30x.html.twig');
	}

	public function demoAction()
	{
		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:demo.html.twig');
	}

	public function demoNotReadyAction()
	{
		return $this->render('PhpbbWebsiteInterfaceBundle:Styles:demoNotReady.html.twig');
	}
}
