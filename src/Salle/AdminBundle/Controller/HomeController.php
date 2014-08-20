<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Noticia');

        $repositoryEvent = $this->getDoctrine()
            ->getRepository('SalleAdminBundle:Evento');

    	$noticia = $repository->findAllNews(0, 3);

    	$deportes = $repository->findBySeccion('Deportes', 0, 4);

    	$tecnologia = $repository->findBySeccion('Tecnología', 0, 4);

        $eventos = $repositoryEvent->findAllEvents(0, 5);

    	return $this->render('SalleAdminBundle:Front:home.html.twig', array (
    		'noticias' => $noticia,
    		'deportes' => $deportes,
    		'tecnologia' => $tecnologia,
            'eventos' => $eventos
    		));
    }

}
