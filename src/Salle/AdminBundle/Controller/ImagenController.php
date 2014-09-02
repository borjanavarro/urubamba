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

         $last = $this->getDoctrine()
            ->getRepository('SalleAdminBundle:Comentario')->findLastComment();;

    	if (!$imagen) {
	        throw $this->createNotFoundException(
	            'No image found for id '.$id
	        );
	    }

    	return $this->render('SalleAdminBundle:Front:imagen.html.twig', array(
            'imagen' => $imagen,
            'last' => $last
            ));
    }
}
