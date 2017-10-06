<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;

/**
 * Created by PhpStorm.
 * User: yoann
 * Date: 06/10/2017
 * Time: 00:08
 */
class MemberRepository extends EntityRepository
{
    public function findAllJoinAddresses()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT m, a FROM AppBundle:Member m LEFT JOIN m.addresses a ORDER BY m.firstName ASC'
            )
            ->getResult();
    }
}