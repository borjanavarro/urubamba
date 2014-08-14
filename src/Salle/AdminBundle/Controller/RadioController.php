<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RadioController extends Controller
{
    public function indexAction()
    {
    	return $this->render('SalleAdminBundle:Front:radio.html.twig');
    }

}
