<?php

namespace phpBB\AdminPanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('phpBBAdminPanelBundle:Default:index.html.twig', array('name' => $name));
    }
}
