<?php

namespace WebsiteBundle\Repository;

/**
 * DateRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DateRepository extends \Doctrine\ORM\EntityRepository
{
  private function findUpcomingDatesQuery() {
    $today = new \DateTime('today');

    $qb = $this->createQueryBuilder('d');
    $qb->where('d.dateShow > :today')
      ->setParameter('today', $today);
    $qb->orderBy('d.dateShow', 'ASC');

    return $qb;
  }

  public function findUpcomingDates() {
    $qb = $this->findUpcomingDatesQuery();

    return $qb->getQuery()->getResult();
  }

  public function findThreeNextDates() {
    $qb = $this->findUpcomingDatesQuery();

    return $qb->getQuery()->setMaxResults(2)->getResult();
  }
}
