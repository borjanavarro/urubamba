<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EditNewsController extends Controller
{
    public function indexAction()
    {
    	return $this->render('SalleAdminBundle:BackOffice:editNews.html.twig');
    }

}
