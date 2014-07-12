<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Salle\AdminBundle\Form\Type\NoticiaType;
use Salle\AdminBundle\Entity\Noticia;

class AddNewsController extends Controller
{
    public function indexAction(Request $request)
    {

    	$form = $this->createForm(new NoticiaType(), null);
        $form->handleRequest($request);


        if ($form->isValid()) {
            
            //$data = $form->getData();

            $noticia = new Noticia();
            $noticia->setTitulo($form->get('titulo')->getData());
            $noticia->setSubtitulo($form->get('subtitulo')->getData());
            $noticia->setCuerpo($form->get('cuerpo')->getData());
            $noticia->setSeccion($form->get('seccion')->getData());
            $noticia->setFile($form->get('file')->getData());
            $noticia->setFecha(new \Datetime("now"));


            $em = $this->getDoctrine()->getManager();
            $em->persist($noticia);
            $em->flush();

            return $this->redirect($this->generateUrl('list-news'));
        }

    	return $this->render('SalleAdminBundle:BackOffice:addNews.html.twig', 
            array('form' => $form->createView()
        ));
    }

}
