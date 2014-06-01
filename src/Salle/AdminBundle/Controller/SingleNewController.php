<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SingleNewController extends Controller
{
    public function indexAction()
    {
    	return $this->render('SalleAdminBundle:Front:noticia.html.twig');
    }

}
