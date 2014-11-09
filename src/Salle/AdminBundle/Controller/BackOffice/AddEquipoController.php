<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Salle\AdminBundle\Form\Type\EquipoType;
use Salle\AdminBundle\Entity\Equipo;

class AddEquipoController extends Controller
{
    public function indexAction(Request $request)
    {
    	$equipo = new Equipo();
    	$form = $this->createForm(new EquipoType(), $equipo);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
        	$em = $this->getDoctrine()->getManager();
            $em->persist($equipo);
            $em->flush();

            return $this->redirect($this->generateUrl('list-equipo'));
        }

        return $this->render('SalleAdminBundle:BackOffice:addEquipo.html.twig', array ('form' => $form->createView()));
    }

}
