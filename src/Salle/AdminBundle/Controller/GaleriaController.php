<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GaleriaController extends Controller
{
    public function indexAction()
    {
    	return $this->render('SalleAdminBundle:Front:galeria.html.twig');
    }

}
