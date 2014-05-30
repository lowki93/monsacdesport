<?php

namespace MonSac\DeSportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MonSacDeSportBundle:Default:index.html.twig');
    }
}
