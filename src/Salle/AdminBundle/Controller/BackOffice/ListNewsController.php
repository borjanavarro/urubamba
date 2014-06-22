<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListNewsController extends Controller
{
    public function indexAction()
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Noticia');

    	$noticia = $repository->findAllNews();

    	return $this->render('SalleAdminBundle:BackOffice:listNews.html.twig', array ('noticias' => $noticia));
        //throw $this->createNotFoundException('The product does not exist'); 
        
    }
}
