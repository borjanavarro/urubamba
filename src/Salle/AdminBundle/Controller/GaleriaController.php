<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GaleriaController extends Controller
{
    public function indexAction(Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Imagen');

    	$results = 2;

    	$imagenes = $repository->findAllImages(0, $results);

    	$numPags = ceil($repository->countImagenes()/$results);

         $last = $this->getDoctrine()
            ->getRepository('SalleAdminBundle:Comentario')->findLastComment();;

    	if ($request->isXmlHttpRequest())
        {
            $offset = $request->get('offset');
            $refresh = $repository->findAllImages($offset, $results);
            return new Response(json_encode(array('refresh' => $refresh)));
        }

    	return $this->render('SalleAdminBundle:Front:galeria.html.twig', array(
            'imagenes' => $imagenes,
            'numPags' => $numPags,
            'last' => $last
            ));
    }

}
