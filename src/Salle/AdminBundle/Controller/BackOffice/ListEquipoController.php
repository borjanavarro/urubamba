<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListEquipoController extends Controller
{
    public function indexAction(Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Equipo');

        $results = 1;

    	$equipo = $repository->findAllEquipo(0, $results);

        $numPags = ceil($repository->countEquipo()/$results);

        if ($request->request->has('delete'))
        {
            $id = $request->request->get('delete');
            $em = $this->getDoctrine()->getManager();
            $miembro = $em->getRepository('SalleAdminBundle:Equipo')->find($id);

            if (!$miembro) {
                throw $this->createNotFoundException(
                    'No miembro found for id '.$id
                );
            }

            $em->remove($miembro);
            $em->flush();

            return $this->redirect($this->generateUrl('list-equipo'));
        }

        if ($request->request->has('edit'))
        {
            $id = $request->request->get('edit');
            return $this->redirect($this->generateUrl('edit-equipo', array('id' => $id)));
        }

        if ($request->isXmlHttpRequest())
        {
            $offset = $request->get('offset');
            $refresh = $repository->findAllEquipo($offset, $results);
            return new Response(json_encode(array('refresh' => $refresh)));
        }

    	return $this->render('SalleAdminBundle:BackOffice:listEquipo.html.twig', array (
    		'equipo' => $equipo,
    		'numPags' => $numPags
    	));
    }

}
