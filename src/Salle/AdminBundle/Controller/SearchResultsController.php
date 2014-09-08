<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchResultsController extends Controller
{
    public function indexAction(Request $request, $mode)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Noticia');

        $results = 1;
        $numResults = 0;
        $numPags = 0;
        $noticias = array();
        $query = '';

    	if ($request->query->has('query'))
        {
            $query = $request->query->get('query');

            if($mode == 'contenido')
	    	{
		    	$noticias = $repository->findNoticiasByString($query, 0, $results);
		    	$numResults = $repository->countNoticiasByString($query);
		        $numPags = ceil($numResults/$results);
	    	}
	    	else if($mode == 'seccion')
	    	{
		    	$noticias = $repository->findBySeccion($query, 0, $results);
		    	$numResults = $repository->countNoticiasBySeccion($query);
		        $numPags = ceil($numResults/$results);
	    	}
	    	else if ($mode == 'fecha')
	    	{
	    		$fechas = split(' ', $query);
		    	$noticias = $repository->findNoticiasByFecha($fechas, 0, $results);
		        $numResults = $repository->countNoticiasByFecha($fechas);
		        $numPags = ceil($numResults/$results);
	    	}
            // return $this->redirect($this->generateUrl('buscar', array('mode' => $mode, 'query' => $query)));
        }

        if ($request->isXmlHttpRequest())
        {
            $offset = $request->get('offset');

            if($mode == 'contenido')
	    	{
		    	$refresh = $repository->findNoticiasByString($query, $offset, $results);
	    	}
	    	else if($mode == 'seccion')
	    	{
		    	$refresh = $repository->findBySeccion($query, $offset, $results);
	    	}
	    	else if ($mode == 'fecha')
	    	{
		    	$fechas = split(' ', $query);
		    	$refresh = $repository->findNoticiasByFecha($fechas, $offset, $results);
	    	}

	    	return new Response(json_encode(array('refresh' => $refresh)));
        }

        $last = $this->getDoctrine()
            ->getRepository('SalleAdminBundle:Comentario')->findLastComment();

    	return $this->render('SalleAdminBundle:Front:search.html.twig', array(
    		'noticias' => $noticias,
    		'mode' => $mode,
    		'query' => $query,
    		'numResults' => $numResults,
    		'numPags' => $numPags,
    		 'last' => $last
    		));
    }

}
