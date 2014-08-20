<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListPatroController extends Controller
{
    public function indexAction(Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Patro');

        $results = 10;

    	$patros = $repository->findAllPatros(0, $results);

        $numPags = ceil($repository->countPatros()/$results);

        if ($request->request->has('delete'))
        {
            $id = $request->request->get('delete');
            $em = $this->getDoctrine()->getManager();
            $patro = $em->getRepository('SalleAdminBundle:Patro')->find($id);

            if (!$patro) {
                throw $this->createNotFoundException(
                    'No patrocinador found for id '.$id
                );
            }

            $em->remove($patro);
            $em->flush();

            return $this->redirect($this->generateUrl('list-patros'));
        }

        if ($request->request->has('edit'))
        {
            $id = $request->request->get('edit');
            return $this->redirect($this->generateUrl('edit-patro', array('id' => $id)));
        }

        if ($request->isXmlHttpRequest())
        {
            $offset = $request->get('offset');
            $refresh = $repository->findAllPatros($offset, $results);
            return new Response(json_encode(array('refresh' => $refresh)));
        }

    	return $this->render('SalleAdminBundle:BackOffice:listPatros.html.twig', array ('patros' => $patros, 'numPags' => $numPags));
    }

}
