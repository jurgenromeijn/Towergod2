<?php

namespace Meesters\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MeestersUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
