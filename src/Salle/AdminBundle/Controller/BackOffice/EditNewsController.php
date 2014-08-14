<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Salle\AdminBundle\Form\Type\NoticiaType;


class EditNewsController extends Controller
{
    public function indexAction($id, Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Noticia');

    	$noticia = $repository->find($id);

    	if (!$noticia) {
        	throw $this->createNotFoundException();
    	}

    	$form = $this->createForm(new NoticiaType(), null);   

        $form->get('titulo')->setData($noticia->getTitulo());
        $form->get('subtitulo')->setData($noticia->getSubtitulo());
        $form->get('cuerpo')->setData($noticia->getCuerpo());
        $form->get('seccion')->setData($noticia->getSeccion());

        $form->handleRequest($request);

        if ($form->isValid()) {

            $noticia->setTitulo($form->get('titulo')->getData());
            $noticia->setSubtitulo($form->get('subtitulo')->getData());
            $noticia->setCuerpo($form->get('cuerpo')->getData());
            $noticia->setSeccion($form->get('seccion')->getData());
            $noticia->setFile($form->get('file')->getData());
            $noticia->setFecha(new \Datetime("now"));

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect($this->generateUrl('list-news'));

        }

    	return $this->render('SalleAdminBundle:BackOffice:editNews.html.twig', 
    		array (
    			'noticia' => $noticia, 
    			'form' => $form->createView()
    		)
    	);
    }

}
