<?php

namespace Salle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Salle\AdminBundle\Entity\Comentario;
use Salle\AdminBundle\Form\Type\ComentarioType;
use Symfony\Component\HttpFoundation\Response;

class SingleNewController extends Controller
{
    public function indexAction(Request $request, $id)
    {
    	$repository = $this->getDoctrine()
    		->getRepository('SalleAdminBundle:Noticia');

    	$noticia = $repository->find($id);

    	if (!$noticia) {
            throw $this->createNotFoundException(
                'No noticia found for id '. $id
            );
        }

        $repositoryCom = $this->getDoctrine()
            ->getRepository('SalleAdminBundle:Comentario');

        $results = 1;

        $comentarios = $repositoryCom->findNoticiaComments ($noticia, 0, $results);

        $numPags = ceil(count($repositoryCom->findBy(
            array ('noticia' => $noticia)))/$results);

        $comentario = new Comentario();
        $form = $this->createForm(new ComentarioType());
        $form->handleRequest($request);

        $last = $this->getDoctrine()
            ->getRepository('SalleAdminBundle:Comentario')->findLastComment();;

        if ($form->isValid()) {

            $comentario->setNombre($form->get('nombre')->getData());
            $comentario->setEmail($form->get('email')->getData());
            $comentario->setComentario($form->get('comentario')->getData());
            $comentario->setFecha(new \Datetime("now"));
            $comentario->setLikes(0);
            $comentario->setDislikes(0);
            $comentario->setNoticia($noticia);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comentario);
            $em->flush();

            return $this->redirect($this->generateUrl('noticia', array ('id' => $id)));

        }

    	$ultimas = $repository->findUltimas($noticia->getId(), 0, 3);

        if ($request->isXmlHttpRequest())
        {
            if ($request->request->has('offset'))
            {
                $offset = $request->get('offset');
                $refresh = $repositoryCom->findNoticiaComments ($noticia, $offset, $results);
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

    	return $this->render('SalleAdminBundle:Front:noticia.html.twig', array (
            'noticia' => $noticia, 
            'ultimas' => $ultimas,
            'comentarios' => $comentarios,
            'numPags' => $numPags, 
            'form' => $form->createView(),
            'last' => $last
            ));
    }

}
