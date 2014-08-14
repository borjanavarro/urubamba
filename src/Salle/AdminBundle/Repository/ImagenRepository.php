<?php

namespace Salle\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ImagenRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ImagenRepository extends EntityRepository
{

	public function findAllImages()
    {
        
        $query = $this->createQueryBuilder('n')
		    ->orderBy('n.fecha', 'DESC')
		    ->setMaxResults(9)
		    ->getQuery();
		 
		$noticias = $query->getResult();

		return $noticias;
    }
}