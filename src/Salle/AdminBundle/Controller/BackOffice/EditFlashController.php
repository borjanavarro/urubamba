<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Salle\AdminBundle\Form\Type\FlashType;

class EditFlashController extends Controller
{
    public function indexAction($id, Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Flash');

    	$flash = $repository->find($id);

    	if (!$flash) {
        	throw $this->createNotFoundException();
    	}

    	$form = $this->createForm(new FlashType(), null);   

        $form->get('titular')->setData($flash->getTitular());
        $form->get('enlace')->setData($flash->getEnlace());

        $form->handleRequest($request);

        if ($form->isValid()) {

            $flash->setTitular($form->get('titular')->getData());
            $flash->setEnlace($form->get('enlace')->getData());
            $flash->setFecha($flash->getFecha());

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect($this->generateUrl('list-flash'));

        }

    	return $this->render('SalleAdminBundle:BackOffice:editFlash.html.twig', 
    		array (
    			'flash' => $flash, 
    			'form' => $form->createView()
    		)
    	);
    }

}
