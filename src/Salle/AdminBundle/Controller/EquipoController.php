<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EquipoController extends Controller
{
    public function indexAction()
    {
    	return $this->render('SalleAdminBundle:Front:equipo.html.twig');
    }

}
