<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Salle\AdminBundle\Form\Type\NoticiaPageType;
use Salle\AdminBundle\Entity\Noticia;
use Salle\AdminBundle\Entity\NoticiaPage;

class ListNewsController extends Controller
{
    public function indexAction(Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Noticia');

    	$noticias = $repository->findAllNews();

        if ($request->request->has('delete2'))
        {
            $this->render("succes");
            die();
        }

    	return $this->render('SalleAdminBundle:BackOffice:listNews.html.twig', array ('noticias' => $noticias));
        
    }
}
