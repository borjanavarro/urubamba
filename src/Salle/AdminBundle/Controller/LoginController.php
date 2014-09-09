<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
    	$last = $this->getDoctrine()
            ->getRepository('SalleAdminBundle:Comentario')->findLastComment();


        return $this->render('SalleAdminBundle:Front:login.html.twig', array(
        	'last' => $last
            ));    
    }

}
