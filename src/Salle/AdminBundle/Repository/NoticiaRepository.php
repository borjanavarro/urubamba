<?php

namespace Salle\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

class NoticiaRepository extends EntityRepository
{
    public function findAllNews($offset, $results)
    {
        
        $query = $this->createQueryBuilder('n')
        	->select(array('n.id','n.titulo','n.subtitulo','n.seccion', 'n.path', 'n.fecha'))
		    ->orderBy('n.fecha', 'DESC')
            ->setFirstResult($results * $offset)
            ->setMaxResults($results)
		    ->getQuery();
		 
		$noticias = $query->getArrayResult();

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

    public function findBySeccion($seccion, $offset, $results)
    {
        
        $query = $this->createQueryBuilder('n')
            ->select(array('n.id','n.titulo','n.subtitulo','n.seccion', 'n.path', 'n.fecha'))
            ->where('n.seccion LIKE \'' . $seccion . '\'')
            ->orderBy('n.fecha', 'DESC')
            ->setFirstResult($results * $offset)
            ->setMaxResults($results)
            ->getQuery();
         
        $noticias = $query->getArrayResult();

        return $noticias;
    }

}