<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($option)
    {
    	if ($option == "news"){
    		return $this->render('SalleAdminBundle:Default:newsList.html.twig');
    	} else {
    		throw $this->createNotFoundException('The product does not exist'); 
    	}
        
    }
}
