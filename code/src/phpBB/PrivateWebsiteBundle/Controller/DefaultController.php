<?php

namespace phpBB\PrivateWebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('phpBBPrivateWebsiteBundle:Default:index.html.twig', array('name' => $name));
    }
}
