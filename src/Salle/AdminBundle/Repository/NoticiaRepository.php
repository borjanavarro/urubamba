<?php

namespace Salle\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

class NoticiaRepository extends EntityRepository
{
    public function findAllNews($offset)
    {
        
        $query = $this->createQueryBuilder('n')
        	->select(array('n.id','n.titulo','n.subtitulo','n.seccion', 'n.path', 'n.fecha'))
		    ->orderBy('n.fecha', 'DESC')
            ->setFirstResult(1 * $offset)
            ->setMaxResults(1)
		    ->getQuery();
		 
		$noticias = $query->getArrayResult();

		return $noticias;
    }

    public function findUltimasNews()
    {
        
        $query = $this->createQueryBuilder('n')
            ->select(array('n.id','n.titulo','n.subtitulo','n.seccion', 'n.path', 'n.fecha'))
            ->orderBy('n.fecha', 'DESC')
            ->setMaxResults(3)
            ->getQuery();
         
        $noticias = $query->getResult();

        return $noticias;
    }

    public function countNoticias ()
    {
        $query = $this->createQueryBuilder('n')
            ->select('count(n.id)')
            ->getQuery();
         
        $count = $query->getSingleScalarResult();

        return $count;
    }

}