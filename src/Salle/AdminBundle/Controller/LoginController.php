<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class LoginController extends Controller
{
    public function indexAction(Request $request)
    {
    	$session = $request->getSession();
 
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

    	$last = $this->getDoctrine()
            ->getRepository('SalleAdminBundle:Comentario')->findLastComment();


        return $this->render('SalleAdminBundle:Front:login.html.twig', array(
        	'last' => $last,
        	'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
            ));    
    }

}
