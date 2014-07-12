<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GaleriaController extends Controller
{
    public function indexAction()
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Imagen');

    	$imagenes = $repository->findAllImages();

    	return $this->render('SalleAdminBundle:Front:galeria.html.twig', array('imagenes' => $imagenes));
    }

}
