<?php
/**
 * 
 * @package phpBBPrivateWebsiteBundle
 * @copyright (c) 2012 phpBB Group
 * @license Not for re-distribution
 * @author Unknown Bliss
 * 
 */

namespace phpBB\PrivateWebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('phpBBPrivateWebsiteBundle:Default:index.html.twig', array('name' => $name));
    }
}
