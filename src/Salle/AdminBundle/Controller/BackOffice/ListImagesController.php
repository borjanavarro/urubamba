<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListImagesController extends Controller
{
	public function indexAction(Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Imagen');

    	$imagenes = $repository->findAllImages(0);

        $numPags = ceil($repository->countImagenes()/1);

    	if ($request->request->has('delete'))
        {
            $id = $request->request->get('delete');
            $em = $this->getDoctrine()->getManager();
            $imagen = $em->getRepository('SalleAdminBundle:Imagen')->find($id);

            if (!$imagen) {
                throw $this->createNotFoundException(
                    'No noticia found for id '.$id
                );
            }

            $em->remove($imagen);
            $em->flush();

            return $this->redirect($this->generateUrl('list-images'));
        }

        if ($request->isXmlHttpRequest())
        {
            $offset = $request->get('offset');
            $refresh = $repository->findAllImages($offset);
            return new Response(json_encode(array('refresh' => $refresh)));
        }

    	return $this->render('SalleAdminBundle:BackOffice:listImages.html.twig', array ('imagenes' => $imagenes, 'numPags' => $numPags));
    }
}
