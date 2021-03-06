<?php

namespace Salle\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * EventoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventoRepository extends EntityRepository
{
	public function findAllEvents($offset, $results)
    {
        
        $query = $this->createQueryBuilder('n')
		    ->orderBy('n.fecha', 'ASC')
            ->setFirstResult($results * $offset)
            ->setMaxResults($results)
            ->where('n.fecha > :today')
            ->setParameter('today', new \Datetime())
		    ->getQuery();
		 
		$evento = $query->getArrayResult();

		return $evento;
    }

    public function countEvents()
    {
    	$query = $this->createQueryBuilder('n')
    		->select('count(n.id)');

    	$count = $query->getQuery()->getSingleScalarResult();

    	return $count;
    }
}
