<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Salle\AdminBundle\Form\Type\DeleteType;

class ListNewsController extends Controller
{
    public function indexAction(Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Noticia');

    	$noticias = $repository->findAllNews();

    	$i = 0;
    	foreach ($noticias as $noticia){
    		$forms[$i] = $this->container->get('form.factory')->create(new DeleteType(), null);
        	$forms[$i]->handleRequest($request);
        	$forms[$i]->createView();
        	$i++;
    	}

    	var_dump($forms);
    	die();


        if ($forms[0]->isValid()) {
        	 if ($forms[0]->get('delete')->isClicked()) {
        	 	

        		return $this->redirect($this->generateUrl('list-news'));
    		}
    	}

    	return $this->render('SalleAdminBundle:BackOffice:listNews.html.twig', array ('noticias' => $noticias, 'forms' => $forms));
        
    }
}
