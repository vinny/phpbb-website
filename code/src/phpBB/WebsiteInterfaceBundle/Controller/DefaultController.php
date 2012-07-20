<?php

namespace phpBB\WebsiteInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('phpBBWebsiteInterfaceBundle:Default:index.html.twig', array('name' => $name));
    }
}
