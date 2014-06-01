<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchResultsController extends Controller
{
    public function indexAction()
    {
    	return $this->render('SalleAdminBundle:Front:search.html.twig');
    }

}
