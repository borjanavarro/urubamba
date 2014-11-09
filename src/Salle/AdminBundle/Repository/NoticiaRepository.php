<?php

namespace Salle\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

class NoticiaRepository extends EntityRepository
{
    public function findAllNews($offset, $results)
    {
        
        $query = $this->createQueryBuilder('n')
		    ->orderBy('n.fecha', 'DESC')
            ->setFirstResult($results * $offset)
            ->setMaxResults($results)
		    ->getQuery();
		 
		$noticias = $query->getArrayResult();

		return $noticias;
    }

    public function findAllNewsHome($offset, $results)
    {
        
        $query = $this->createQueryBuilder('n')
            ->orderBy('n.fecha', 'DESC')
            ->setFirstResult($results * $offset)
            ->setMaxResults($results)
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

    public function findBySeccion($seccion, $offset, $results)
    {
        
        $query = $this->createQueryBuilder('n')
            ->select(array('n.id','n.titulo','n.subtitulo','n.cuerpo', 'n.seccion', 'n.path', 'n.fecha'))
            ->where('n.seccion LIKE \'' . $seccion . '\'')
            ->orderBy('n.fecha', 'DESC')
            ->setFirstResult($results * $offset)
            ->setMaxResults($results)
            ->getQuery();
         
        $noticias = $query->getArrayResult();

        return $noticias;
    }

    public function findUltimas($id, $offset, $results)
    {
        
        $query = $this->createQueryBuilder('n')
            ->select(array('n.id','n.titulo'))
            ->where('n.id != \'' . $id . '\'')
            ->orderBy('n.fecha', 'DESC')
            ->setFirstResult($results * $offset)
            ->setMaxResults($results)
            ->getQuery();
         
        $noticias = $query->getArrayResult();

        return $noticias;
    }

    public function findNoticiasByString($cad, $offset, $results)
    {
        
        $query = $this->createQueryBuilder('n')
            ->select(array('n.id','n.titulo','n.subtitulo', 'n.cuerpo', 'n.seccion', 'n.fecha'))
            ->where('n.titulo LIKE \'%' . $cad . '%\' OR n.subtitulo LIKE \'%' . $cad . '%\' OR n.cuerpo LIKE \'%' . $cad . '%\'')
            ->orderBy('n.fecha', 'DESC')
            ->setFirstResult($results * $offset)
            ->setMaxResults($results)
            ->getQuery();
         
        $noticias = $query->getArrayResult();

        return $noticias;
    }

    public function countNoticiasByString ($cad)
    {

        $query = $this->createQueryBuilder('n')
            ->select('count(n.id)')
            ->where('n.titulo LIKE \'%' . $cad . '%\' OR n.subtitulo LIKE \'%' . $cad . '%\' OR n.cuerpo LIKE \'%' . $cad . '%\'')
            ->getQuery();
         
        $count = $query->getSingleScalarResult();

        return $count;
    }

    public function countNoticiasBySeccion ($seccion)
    {

        $query = $this->createQueryBuilder('n')
            ->select('count(n.id)')
            ->where('n.seccion LIKE \'' . $seccion . '\'')
            ->getQuery();
         
        $count = $query->getSingleScalarResult();

        return $count;
    }

    public function findNoticiasByFecha($fechas, $offset, $results)
    {
        
        $query = $this->createQueryBuilder('n')
            ->select(array('n.id','n.titulo','n.subtitulo', 'n.cuerpo', 'n.seccion', 'n.fecha'))
            ->where('n.fecha <= \'' . $fechas[0] . '\' AND n.fecha >= \'' . $fechas[1] . '\'')
            ->orderBy('n.fecha', 'DESC')
            ->setFirstResult($results * $offset)
            ->setMaxResults($results)
            ->getQuery();
         
        $noticias = $query->getArrayResult();

        return $noticias;
    }

    public function countNoticiasByFecha ($fechas)
    {

        $query = $this->createQueryBuilder('n')
            ->select('count(n.id)')
            ->where('n.fecha <= \'' . $fechas[0] . '\' AND n.fecha >= \'' . $fechas[1] . '\'')
            ->getQuery();
         
        $count = $query->getSingleScalarResult();

        return $count;
    }

}