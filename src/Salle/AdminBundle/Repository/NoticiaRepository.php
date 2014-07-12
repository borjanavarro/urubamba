<?php

namespace Salle\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

class NoticiaRepository extends EntityRepository
{
    public function findAllNews()
    {
        
        $query = $this->createQueryBuilder('n')
        	->select(array('n.id','n.titulo','n.subtitulo','n.seccion', 'n.path', 'n.fecha'))
		    ->orderBy('n.fecha', 'DESC')
		    ->getQuery();
		 
		$noticias = $query->getResult();

		return $noticias;
    }

    public function findUltimasNews()
    {
        
        $query = $this->createQueryBuilder('n')
            ->select(array('n.id','n.titulo'))
            ->orderBy('n.fecha', 'DESC')
            ->setMaxResults(3)
            ->getQuery();
         
        $noticias = $query->getResult();

        return $noticias;
    }

}