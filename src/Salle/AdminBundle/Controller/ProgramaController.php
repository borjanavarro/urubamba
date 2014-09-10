<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProgramaController extends Controller
{
    public function indexAction()
    {
    	// Ultimo comentario footer

    	$last = $this->getDoctrine()
            ->getRepository('SalleAdminBundle:Comentario')->findLastComment();

        return $this->render('SalleAdminBundle:Front:programa.html.twig', array(
        	'last' => $last
            ));    
	}

}
