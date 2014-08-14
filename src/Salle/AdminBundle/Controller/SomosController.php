<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SomosController extends Controller
{
    public function indexAction()
    {
    	return $this->render('SalleAdminBundle:Front:somos.html.twig');
    }

}
