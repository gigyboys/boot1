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
    public function getSchoolSearch($critere)
    {
        $qb = $this->createQueryBuilder('school');

        $qb
        ->where('school.name LIKE :critere OR school.shortName LIKE :critere')
        /*->orWhere('project.description LIKE :critere')*/
        ->setParameter('critere', '%'.$critere.'%')
        ->orderBy('school.name', 'ASC')
        ;

        return $qb
        ->getQuery()
        ->getResult()
        ;
    }
}