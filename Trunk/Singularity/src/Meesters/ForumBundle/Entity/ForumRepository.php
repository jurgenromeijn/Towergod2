<?php

namespace Meesters\ForumBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ForumRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ForumRepository extends EntityRepository
{
    
//    public function findAllOrderedByPosition()
//    {
//        $this->getEntityManager()->createQueryBuilder()
//                ->select("f, c, p")
//                ->from("MeestersForumBundle:Forum", "f")
//                ->join("f.category", "c")
//                ->join("f.last_post", "p")
//                ->orderBy($sort);
//    }
}