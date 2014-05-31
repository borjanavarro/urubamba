<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AddNewsController extends Controller
{
    public function indexAction()
    {
    	return $this->render('SalleAdminBundle:BackOffice:addNews.html.twig');
    }

}
