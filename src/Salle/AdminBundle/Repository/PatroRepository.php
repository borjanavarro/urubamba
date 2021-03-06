<?php

namespace Salle\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PatroRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PatroRepository extends EntityRepository
{

	public function findAllPatros($offset, $results)
    {
        
        $query = $this->createQueryBuilder('n')
        	->select(array('n.id','n.titulo','n.descripcion', 'n.path', 'n.fecha'))
		    ->orderBy('n.fecha', 'DESC')
            ->setFirstResult($results * $offset)
            ->setMaxResults($results)
		    ->getQuery();
		 
		$patros = $query->getArrayResult();

		return $patros;
    }

    public function countPatros ()
    {

        $query = $this->createQueryBuilder('n')
            ->select('count(n.id)')
            ->getQuery();
         
        $count = $query->getSingleScalarResult();

        return $count;
    }
}
