<?php

namespace WF\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * FreelancerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FreelancerRepository extends EntityRepository
{
	public function getAllfreelancer($page,$nbPerPage)
	{
		$query = $this->createQueryBuilder('f')
		
		    ->addSelect('f')
			
			->getQuery()
			;
			$query
				->setFirstResult(($page-1)*$nbPerPage)
				->setMaxResults($nbPerPage)
				;

			return new Paginator($query,true) ;
    }
}