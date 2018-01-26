<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @param string $order
     * @return \Doctrine\ORM\Query
     */
    public function getAllQuery(string $order = 'ASC'): Query {
        return $this->createQueryBuilder('p')
            ->orderBy('p.createdAt', $order)
            ->getQuery();
    }
}
