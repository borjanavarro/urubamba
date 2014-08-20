<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PatroController extends Controller
{
    public function indexAction()
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Patro');

    	$patros = $repository->findAllPatros(0, 100);

    	return $this->render('SalleAdminBundle:Front:patro.html.twig', array ('patros' => $patros));

    }

}
