<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListFlashController extends Controller
{
    public function indexAction(Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Flash');

        $results = 2;

    	$flashes = $repository->findAllFlash(0, $results);

        $numPags = ceil($repository->countFlash()/$results);

    	if ($request->request->has('delete'))
        {
            $id = $request->request->get('delete');
            $em = $this->getDoctrine()->getManager();
            $flash = $repository->find($id);

            if (!$flash) {
                throw $this->createNotFoundException(
                    'No comentario found for id '.$id
                );
            }

            $em->remove($flash);
            $em->flush();

            return $this->redirect($this->generateUrl('list-flash'));
        }

        if ($request->request->has('edit'))
        {
            $id = $request->request->get('edit');
            return $this->redirect($this->generateUrl('edit-flash', array('id' => $id)));
        }

        if ($request->isXmlHttpRequest())
        {
            $offset = $request->get('offset');
            $refresh = $repository->findAllFlash($offset, $results);
            return new Response(json_encode(array('refresh' => $refresh)));
        }

    	return $this->render('SalleAdminBundle:BackOffice:listFlash.html.twig', array ('flashes' => $flashes, 'numPags' => $numPags));
    }

}
