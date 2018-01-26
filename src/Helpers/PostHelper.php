<?php

namespace App\Helpers;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Psr\Container\ContainerInterface;

class PostHelper
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * PostHelper constructor.
     * @param EntityManagerInterface $entityManager
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(EntityManagerInterface $entityManager, ContainerInterface $container) {
        $this->entityManager = $entityManager;
        $this->postRepository = $entityManager->getRepository(Post::class);
        $this->paginator = $container->get('knp_paginator');
    }

    /**
     * @param int $page
     * @param int|null $limit
     * @return PaginationInterface
     */
    public function getAll(int $page = 1, int $limit = 3
    ): PaginationInterface {
        return $this->paginator->paginate($this->postRepository->getAllQuery(), $page, $limit);
    }

    /**
     * @param Post $post
     */
    public function save(Post $post): void {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

    /**
     * @param Post $post
     */
    public function remove(Post $post): void {
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }
}