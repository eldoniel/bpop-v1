<?php

namespace WebsiteBundle\Repository;

/**
 * VideoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VideoRepository extends \Doctrine\ORM\EntityRepository
{
  public function findLatestVideo() {
    $qb = $this->createQueryBuilder('v');
    $qb->setMaxResults( 1 );
    $qb->orderBy('v.date', 'DESC');

    return $qb->getQuery()->getSingleResult();
  }
}
