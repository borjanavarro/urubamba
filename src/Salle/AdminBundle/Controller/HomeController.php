<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Noticia');

    	$noticia = $repository->findAllNews();

    	return $this->render('SalleAdminBundle:Front:home.html.twig', array ('noticias' => $noticia));
    }

}
