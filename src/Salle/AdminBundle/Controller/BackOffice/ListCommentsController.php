<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListCommentsController extends Controller
{
    public function indexAction(Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Comentario');

        $results = 10;

    	$comentarios = $repository->findAllComments(0, $results);

        $numPags = ceil($repository->getNumberComments()/$results);

    	if ($request->request->has('delete'))
        {
            $id = $request->request->get('delete');
            $em = $this->getDoctrine()->getManager();
            $comentario = $repository->find($id);

            if (!$comentario) {
                throw $this->createNotFoundException(
                    'No comentario found for id '.$id
                );
            }

            $em->remove($comentario);
            $em->flush();

            return $this->redirect($this->generateUrl('list-comments'));
        }

        if ($request->isXmlHttpRequest())
        {
            $offset = $request->get('offset');
            $refresh = $repository->findAllComments($offset, $results);
            return new Response(json_encode(array('refresh' => $refresh)));
        }

    	return $this->render('SalleAdminBundle:BackOffice:listComments.html.twig', array ('comentarios' => $comentarios, 'numPags' => $numPags));
    }

}
