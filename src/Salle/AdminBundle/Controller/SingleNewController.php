<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SingleNewController extends Controller
{
    public function indexAction(Request $request, $id)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Noticia');

    	$noticia = $repository->find($id);

    	if (!$noticia) {
            throw $this->createNotFoundException(
                'No noticia found for id '.$id
            );
        }

        $service = $this->get('comentarios');
        $form = $service->getForm($noticia);

        if ($form == null) {
            return $this->redirect($this->generateUrl('noticia', array ('id' => $id )));
        }

    	$ultimas = $repository->findUltimasNews();

    	return $this->render('SalleAdminBundle:Front:noticia.html.twig', array (
            'noticia' => $noticia, 
            'ultimas' => $ultimas, 
            'form' => $form->createView()
            ));
    }

}
