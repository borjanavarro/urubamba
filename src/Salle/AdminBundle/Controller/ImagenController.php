<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Salle\AdminBundle\Entity\Comentario;
use Salle\AdminBundle\Form\Type\ComentarioType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ImagenController extends Controller
{
	public function indexAction($id, Request $request)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Imagen');

    	$imagen = $repository->find($id);

        if (!$imagen) {
            throw $this->createNotFoundException(
                'No image found for id '.$id
            );
        }

        // Comentarios de la radio

        $results = 10;

        $repositoryCom = $this->getDoctrine()
            ->getRepository('SalleAdminBundle:Comentario');

        $comentarios = $repositoryCom->findImagenComments($imagen, 0, $results);

        $numComments = count($repositoryCom->findByImagen($imagen));

        $numPags = ceil($numComments/$results);

        // Insertar comentario en la imagen

        $comentario = new Comentario();
        $form = $this->createForm(new ComentarioType());
        $form->handleRequest($request);

        if ($form->isValid()) {

            $comentario->setNombre($form->get('nombre')->getData());
            $comentario->setEmail($form->get('email')->getData());
            $comentario->setComentario($form->get('comentario')->getData());
            $comentario->setFecha(new \Datetime("now"));
            $comentario->setLikes(0);
            $comentario->setDislikes(0);
            $comentario->setImagen($imagen);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comentario);
            $em->flush();

            return $this->redirect($this->generateUrl('imagen', array('id' => $id)));

        }

        // AJAX 

        if ($request->isXmlHttpRequest())
        {
            if ($request->request->has('offset'))
            {
                $offset = $request->get('offset');
                $refresh = $repositoryCom->findImagenComments($imagen, $offset, $results);
                return new Response(json_encode(array('refresh' => $refresh)));
            }
            else if ($request->request->has('mode'))
            {
                $idCom = $request->get('idCom');
                $comentarioAux = $repositoryCom->find($idCom);
                if (!$comentarioAux) {
                    throw $this->createNotFoundException(
                        'No comentario found for id '. $id
                    );
                 }
                $mode = $request->get('mode');

                if ( $mode == 'up')
                {
                    $comentarioAux->setLikes($comentarioAux->getLikes() + 1);
                }
                else if ( $mode == 'down')
                {
                    $comentarioAux->setDislikes($comentarioAux->getDislikes() + 1);
                }

                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return new Response(json_encode(array()));
            }
        }

        // Ultimo comentario footer

        $last = $this->getDoctrine()
            ->getRepository('SalleAdminBundle:Comentario')->findLastComment();;

    	return $this->render('SalleAdminBundle:Front:imagen.html.twig', array(
            'numComments' => $numComments,
            'numPags' => $numPags,
            'form' => $form->createView(),
            'comentarios' => $comentarios,
            'imagen' => $imagen,
            'last' => $last
            ));
    }
}
