<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProductsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductsRepository extends EntityRepository {

    public function getProductsByTag($tag_filter) {
        $qb = $this->createQueryBuilder('p')
                        ->innerJoin('p.tags', 't')
                        ->where('t.tag like :tag')
                        ->setParameter('tag', '%' . $tag_filter . '%')
                        ->getQuery()->getResult();

        return $qb;
    }

}