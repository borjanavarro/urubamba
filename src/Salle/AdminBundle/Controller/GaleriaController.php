<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GaleriaController extends Controller
{
    public function indexAction()
    {
    	return $this->render('SalleAdminBundle:Default:galeria.html.twig');
    }

}
