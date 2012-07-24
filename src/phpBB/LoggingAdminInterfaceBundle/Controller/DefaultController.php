<?php

namespace phpBB\LoggingAdminInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('phpBBLoggingAdminInterfaceBundle:Default:index.html.twig', array('name' => $name));
    }
}
