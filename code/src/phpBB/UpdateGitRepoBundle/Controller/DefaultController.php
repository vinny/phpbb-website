<?php

namespace phpBB\UpdateGitRepoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('phpBBUpdateGitRepoBundle:Default:index.html.twig', array('name' => $name));
    }
}
