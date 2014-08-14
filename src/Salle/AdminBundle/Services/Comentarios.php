<?php

namespace Salle\AdminBundle\Services;

use Symfony\Component\HttpFoundation\RequestStack;
use Salle\AdminBundle\Form\Type\ComentarioType;
use Salle\AdminBundle\Entity\Comentario;
use Salle\AdminBundle\Repository\ComentarioRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class Comentarios
{
	private $request;
	private $formFactory;
	private $em;
	private $router;

	function __construct(RequestStack $requestStack, 
		FormFactoryInterface $formFactory, 
		EntityManager $em,
		Router $router)
	{
		$this->request = $requestStack;
		$this->formFactory = $formFactory;
		$this->em = $em;
		$this->router = $router;
	}

    public function getComments()
    {
    	$repository = $this->em
    		->getRepository('SalleAdminBundle:Comentario');

    	return $repository->findAllComments();
    }

    public function getForm($noticia)
    {
    	$comentario = new Comentario();
    	$form = $this->formFactory->create(new ComentarioType());
        $form->handleRequest($this->request->getCurrentRequest());


        if ($form->isValid()) {

            $comentario->setNombre($form->get('nombre')->getData());
            $comentario->setEmail($form->get('email')->getData());
            $comentario->setComentario($form->get('comentario')->getData());
            $comentario->setFecha(new \Datetime("now"));
            $comentario->setLikes(0);
            $comentario->setDislikes(0);
            $comentario->setNoticia($noticia);

            $this->em->persist($comentario);
            $this->em->flush();

            return null;
        }

        return $form;
    }

}
