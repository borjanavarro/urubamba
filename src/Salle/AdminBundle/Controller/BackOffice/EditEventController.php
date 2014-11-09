<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Salle\AdminBundle\Form\Type\EventoType;

class EditEventController extends Controller
{
    public function indexAction($id, Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Evento');

    	$evento = $repository->find($id);

    	if (!$evento) {
        	throw $this->createNotFoundException();
    	}

    	$form = $this->createForm(new EventoType(), null);   

        $form->get('descripcion')->setData($evento->getDescripcion());
        $form->get('lugar')->setData($evento->getLugar());
        $form->get('fecha')->setData($evento->getFecha());

        $form->handleRequest($request);

        if ($form->isValid()) {

            $evento->setDescripcion($form->get('descripcion')->getData());
            $evento->setLugar($form->get('lugar')->getData());
            $evento->setFecha($evento->getFecha());

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect($this->generateUrl('list-events'));

        }

    	return $this->render('SalleAdminBundle:BackOffice:editEvent.html.twig', 
    		array (
    			'evento' => $evento, 
    			'form' => $form->createView()
    		)
    	);
    	
    }

}
