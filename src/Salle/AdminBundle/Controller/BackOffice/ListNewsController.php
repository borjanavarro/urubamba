<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListNewsController extends Controller
{
    public function indexAction()
    {
    	return $this->render('SalleAdminBundle:BackOffice:listNews.html.twig');
        //throw $this->createNotFoundException('The product does not exist'); 
        
    }
}
