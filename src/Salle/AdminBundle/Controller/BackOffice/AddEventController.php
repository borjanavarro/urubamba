<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Salle\AdminBundle\Form\Type\EventoType;
use Salle\AdminBundle\Entity\Evento;

class AddEventController extends Controller
{
    public function indexAction(Request $request)
    {
    	$evento = new Evento();
    	$form = $this->createForm(new EventoType(), $evento);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $evento->setDescripcion($form->get('descripcion')->getData());
            $evento->setLugar($form->get('lugar')->getData());
            $evento->setFecha($form->get('fecha')->getData());
            
        	$em = $this->getDoctrine()->getManager();
            $em->persist($evento);
            $em->flush();

            return $this->redirect($this->generateUrl('list-events'));
        }

    	return $this->render('SalleAdminBundle:BackOffice:addEvent.html.twig', array ('form' => $form->createView()));
    }

}
