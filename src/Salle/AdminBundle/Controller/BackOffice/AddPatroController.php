<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Salle\AdminBundle\Form\Type\PatroType;
use Salle\AdminBundle\Entity\Patro;

class AddPatroController extends Controller
{
    public function indexAction(Request $request)
    {
    	$form = $this->createForm(new PatroType(), null);
        $form->handleRequest($request);


        if ($form->isValid()) {

            $patro = new Patro();
            $patro->setTitulo($form->get('titulo')->getData());
            $patro->setDescripcion($form->get('descripcion')->getData());
            $patro->setFile($form->get('file')->getData());
            $patro->setFecha(new \Datetime("now"));


            $em = $this->getDoctrine()->getManager();
            $em->persist($patro);
            $em->flush();

            return $this->redirect($this->generateUrl('list-patros'));
        }

    	return $this->render('SalleAdminBundle:BackOffice:addPatro.html.twig', 
            array('form' => $form->createView()
        ));
    }

}
