<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RadioController extends Controller
{
    public function indexAction()
    {
    	return $this->render('SalleAdminBundle:Default:radio.html.twig');
    }

}
