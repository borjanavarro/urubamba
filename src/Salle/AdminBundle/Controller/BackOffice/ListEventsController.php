<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListEventsController extends Controller
{
    public function indexAction( Request $request )
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Evento');

        $results = 1;

    	$eventos = $repository->findAllEvents(0, $results);

        $numPags = ceil($repository->countEvents()/$results);

        if ($request->request->has('delete'))
        {
            $id = $request->request->get('delete');
            $em = $this->getDoctrine()->getManager();
            $evento = $em->getRepository('SalleAdminBundle:Evento')->find($id);

            if (!$evento) {
                throw $this->createNotFoundException(
                    'No evento found for id '.$id
                );
            }

            $em->remove($evento);
            $em->flush();

            return $this->redirect($this->generateUrl('list-events'));
        }

        if ($request->request->has('edit'))
        {
            $id = $request->request->get('edit');
            return $this->redirect($this->generateUrl('edit-event', array('id' => $id)));
        }

        if ($request->isXmlHttpRequest())
        {
            $offset = $request->get('offset');
            $refresh = $repository->findAllEvents($offset, $results);
            return new Response(json_encode(array('refresh' => $refresh)));
        }

    	return $this->render('SalleAdminBundle:BackOffice:listEvents.html.twig', array ('eventos' => $eventos, 'numPags' => $numPags));
    }

}
