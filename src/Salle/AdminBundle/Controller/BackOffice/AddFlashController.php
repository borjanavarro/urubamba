<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Salle\AdminBundle\Form\Type\FlashType;
use Salle\AdminBundle\Entity\Flash;

class AddFlashController extends Controller
{
    public function indexAction(Request $request)
    {
    	$flash = new Flash();
    	$form = $this->createForm(new FlashType(), $flash);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $flash->setTitular($form->get('titular')->getData());
            $flash->setEnlace($form->get('enlace')->getData());
            $flash->setFecha(new \Datetime("now"));
            
        	$em = $this->getDoctrine()->getManager();
            $em->persist($flash);
            $em->flush();

            return $this->redirect($this->generateUrl('list-flash'));
        }

    	return $this->render('SalleAdminBundle:BackOffice:addFlash.html.twig', array ('form' => $form->createView()));
    }

}
