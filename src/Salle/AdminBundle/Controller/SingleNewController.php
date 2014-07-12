<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SingleNewController extends Controller
{
    public function indexAction($id)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Noticia');

    	$noticia = $repository->find($id);

    	if (!$noticia) {
            throw $this->createNotFoundException(
                'No noticia found for id '.$id
            );
        }

    	$ultimas = $repository->findUltimasNews();

    	return $this->render('SalleAdminBundle:Front:noticia.html.twig', array ('noticia' => $noticia, 'ultimas' => $ultimas));
    }

}
