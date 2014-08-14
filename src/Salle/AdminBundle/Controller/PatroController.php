<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PatroController extends Controller
{
    public function indexAction()
    {

    	return $this->render('SalleAdminBundle:Front:patro.html.twig');

    }

}
