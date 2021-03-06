<?php

namespace WebsiteBundle\Repository;

/**
 * ScPlaylistRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ScPlaylistRepository extends \Doctrine\ORM\EntityRepository
{
  public function findThreeLastPlaylists() {
    $qb = $this->createQueryBuilder('s');
    $qb->setMaxResults( 3 );
    $qb->orderBy('s.id', 'DESC');

    return $qb->getQuery()->getResult();
  }
  
  public function findLastPlaylist() {
    $qb = $this->createQueryBuilder('s');
    $qb->setMaxResults( 1 );
    $qb->orderBy('s.id', 'DESC');

    return $qb->getQuery()->getSingleResult();
  }
}
