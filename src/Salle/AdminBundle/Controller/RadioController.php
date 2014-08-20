<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RadioController extends Controller
{
    public function indexAction()
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Flash');

    	$flashes = $repository->findAllFlash(0, 5);

    	return $this->render('SalleAdminBundle:Front:radio.html.twig', array ('flashes' => $flashes));
    }

}
