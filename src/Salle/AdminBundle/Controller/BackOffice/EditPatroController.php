<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Salle\AdminBundle\Form\Type\PatroType;

class EditPatroController extends Controller
{
    public function indexAction($id, Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Patro');

    	$patro = $repository->find($id);

    	if (!$patro) {
        	throw $this->createNotFoundException();
    	}

    	$form = $this->createForm(new PatroType(), null);   

        $form->get('titulo')->setData($patro->getTitulo());
        $form->get('descripcion')->setData($patro->getDescripcion());

        $form->handleRequest($request);

        if ($form->isValid()) {

            $patro->setTitulo($form->get('titulo')->getData());
            $patro->setDescripcion($form->get('descripcion')->getData());
            $patro->setFile($form->get('file')->getData());
            $patro->setFecha($patro->getFecha());

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect($this->generateUrl('list-patros'));

        }

    	return $this->render('SalleAdminBundle:BackOffice:editPatro.html.twig', 
    		array (
    			'patro' => $patro, 
    			'form' => $form->createView()
    		)
    	);
    }

}
