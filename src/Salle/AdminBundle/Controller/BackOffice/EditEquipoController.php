<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Salle\AdminBundle\Form\Type\EquipoType;

class EditEquipoController extends Controller
{
    public function indexAction($id, Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Equipo');

    	$miembro = $repository->find($id);

    	if (!$miembro) {
        	throw $this->createNotFoundException();
    	}

    	$form = $this->createForm(new EquipoType(), $miembro);   

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect($this->generateUrl('list-equipo'));

        }

    	return $this->render('SalleAdminBundle:BackOffice:editEquipo.html.twig', 
    		array (
    			'miembro' => $miembro, 
    			'form' => $form->createView()
    		)
    	);
    }

}
