<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListNewsController extends Controller
{
    public function indexAction(Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Noticia');

        $results = 1;

    	$noticias = $repository->findAllNews(0, $results);

        $numPags = ceil($repository->countNoticias()/$results);

        if ($request->request->has('delete'))
        {
            $id = $request->request->get('delete');
            $em = $this->getDoctrine()->getManager();
            $noticia = $em->getRepository('SalleAdminBundle:Noticia')->find($id);

            if (!$noticia) {
                throw $this->createNotFoundException(
                    'No noticia found for id '.$id
                );
            }

            $em->remove($noticia);
            $em->flush();

            return $this->redirect($this->generateUrl('list-news'));
        }

        if ($request->request->has('edit'))
        {
            $id = $request->request->get('edit');
            return $this->redirect($this->generateUrl('edit-news', array('id' => $id)));
        }

        if ($request->isXmlHttpRequest())
        {
            $offset = $request->get('offset');
            $refresh = $repository->findAllNews($offset, $results);
            return new Response(json_encode(array('refresh' => $refresh)));
        }

    	return $this->render('SalleAdminBundle:BackOffice:listNews.html.twig', array ('noticias' => $noticias, 'numPags' => $numPags));
        
    }

}
