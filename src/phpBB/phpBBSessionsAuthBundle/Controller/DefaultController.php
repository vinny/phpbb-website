<?php

namespace phpBB\phpBBSessionsAuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('phpBBphpBBSessionsAuthBundle:Default:index.html.twig', array('name' => $name));
    }
}
