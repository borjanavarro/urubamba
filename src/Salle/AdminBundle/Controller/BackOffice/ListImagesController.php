<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListImagesController extends Controller
{
	public function indexAction(Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Imagen');

    	$imagenes = $repository->findAllImages();

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

    	return $this->render('SalleAdminBundle:BackOffice:listImages.html.twig', array ('imagenes' => $imagenes));
    }
}
