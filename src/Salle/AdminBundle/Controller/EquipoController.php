<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EquipoController extends Controller
{
    public function indexAction()
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Equipo');

        $results = 1;

    	$equipo = $repository->findAllEquipo(0, $results);

        $numPags = ceil($repository->countEquipo()/$results);

         $last = $this->getDoctrine()
            ->getRepository('SalleAdminBundle:Comentario')->findLastComment();;

    	return $this->render('SalleAdminBundle:Front:equipo.html.twig', array(
    		'equipo' => $equipo,
    		'last' => $last
    		));
    }

}
