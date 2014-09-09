<?php

namespace Salle\AdminBundle\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Salle\AdminBundle\Form\Type\ImagenType;
use Salle\AdminBundle\Entity\Imagen;

class AddImageController extends Controller
{
    public function indexAction(Request $request)
    {
    	$imagen = new Imagen();
    	$form = $this->createForm(new ImagenType(), $imagen);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $imagen->setTitulo($form->get('titulo')->getData());
            $imagen->setDescripcion($form->get('descripcion')->getData());
            $imagen->setFile($form->get('file')->getData());
            $imagen->setFecha(new \Datetime("now"));
            
        	$em = $this->getDoctrine()->getManager();
            $em->persist($imagen);
            $em->flush();

            $this->get('image.handling')->open('bundles/salleadmin/img/galeria/' . $imagen->getId() . '.' . $imagen->getPath())
                ->scaleResize(350, 225, '0xffffff')
                ->save('bundles/salleadmin/img/galeria/thumbnails/' . $imagen->getId() . '.' . $imagen->getPath());

            return $this->redirect($this->generateUrl('list-images'));
        }

    	return $this->render('SalleAdminBundle:BackOffice:addImage.html.twig', array('form' => $form->createView()));
    }

}
