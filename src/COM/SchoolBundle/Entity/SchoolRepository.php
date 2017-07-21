<?php

namespace COM\SchoolBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SchoolRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SchoolRepository extends EntityRepository
{
	//search
    public function getSchoolSearch($critere, $publishState = 2)
    {
        $qb = $this->createQueryBuilder('school');

        $qb
        ->where('school.name LIKE :critere OR school.shortName LIKE :critere')
        ->setParameter('critere', '%'.$critere.'%');
		
		if($publishState == 0){
			$qb
			->andWhere('school.published = :published')
			->setParameter('published', false);
		}
		
		if($publishState == 1){
			$qb
			->andWhere('school.published = :published')
			->setParameter('published', true);
		}
		
		$qb
        ->orderBy('school.name', 'ASC')
        ;

        return $qb
        ->getQuery()
        ->getResult()
        ;
    }
	
	public function getSchoolOffsetLimit($offset, $limit, $publishState = 2) {
		
		$qb = $this->createQueryBuilder('school');

		if($publishState == 0){
			$qb
			->where('school.published = :published')
			->setParameter('published', false);
		}
		
		if($publishState == 1){
			$qb
			->where('school.published = :published')
			->setParameter('published', true);
		}
		
		$qb
		->setFirstResult($offset)
		->setMaxResults($limit)
		;
		
        $schools = $qb->getQuery()->getResult();
		return $schools;
    }
	
	public function getLastAddedSchools($limit) {
		
		$qb = $this->createQueryBuilder('school');

		$qb
		->where('school.published = :published')
		->setParameter('published', true)
		->orderBy('school.id', 'DESC');;

		$qb
		->setMaxResults($limit)
		;
		
        $schools = $qb->getQuery()->getResult();
		return $schools;
    }
}
