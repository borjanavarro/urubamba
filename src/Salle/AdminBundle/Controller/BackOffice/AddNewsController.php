<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddNewsController extends Controller
{
    public function indexAction(Request $request)
    {
    	$defaultData = array('message' => 'Type your message here');
    	$form = $this->createFormBuilder($defaultData)
        ->add('titulo', 'text')
        ->add('subtitulo', 'text')
        ->add('cuerpo', 'textarea')
        ->add('imagen', 'file')
        ->add('seccion', 'choice', array(
        	'choices' => array(
        		'inter' => 'Internacional', 
        		'eco' => 'Economía', 
        		'cult' => 'Cultura', 
        		'soc' => 'Sociedad', 
        		'dep' => 'Deportes')
        	))
        ->add('send', 'submit', array(
        	'label' => 'Añadir')
        	)
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        // data is an array with "name", "email", and "message" keys
        $data = $form->getData();
    }
    	return $this->render('SalleAdminBundle:BackOffice:addNews.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
