<?php

namespace Salle\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

class NoticiaRepository extends EntityRepository
{
    public function findAllNews()
    {
        // $repository = $this->getDoctrine()
        // 	->getRepository('SalleAdminBundle:Noticia');
        
        $query = $this->createQueryBuilder('n')
		    //->setParameter('price', '19.99')
        	->select(array('n.id','n.titulo','n.subtitulo','n.seccion', 'n.foto', 'n.fecha'))
		    ->orderBy('n.fecha', 'DESC')
		    ->getQuery();
		 
		$noticias = $query->getResult();

		return $noticias;
    }

    public function findUltimasNews()
    {
        // $repository = $this->getDoctrine()
        //  ->getRepository('SalleAdminBundle:Noticia');
        
        $query = $this->createQueryBuilder('n')
            ->select(array('n.id','n.titulo'))
            ->orderBy('n.fecha', 'DESC')
            ->getQuery();
         
        $noticias = $query->getResult();

        return $noticias;
    }

}