<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ImagenController extends Controller
{
	public function indexAction($id)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Imagen');

    	$imagen = $repository->find($id);

    	return $this->render('SalleAdminBundle:Front:imagen.html.twig', array('imagen' => $imagen));
    }
}
