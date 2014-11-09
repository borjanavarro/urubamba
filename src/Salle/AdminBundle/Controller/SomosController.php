<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SomosController extends Controller
{
    public function indexAction()
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Noticia');

        $noticias = $repository->countNoticias();

        $repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Imagen');

        $imagenes = $repository->countImagenes();

        $repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Comentario');

        $comentarios = $repository->getNumberComments();

        $repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Evento');

        $eventos = $repository->countEvents();

         $last = $this->getDoctrine()
            ->getRepository('SalleAdminBundle:Comentario')->findLastComment();;


    	return $this->render('SalleAdminBundle:Front:somos.html.twig', array(
    		'noticias' => $noticias,
    		'imagenes' => $imagenes,
    		'comentarios' => $comentarios,
    		'eventos' => $eventos,
            'last' => $last
    		));
    }

}
