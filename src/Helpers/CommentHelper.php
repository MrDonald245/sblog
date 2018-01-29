<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 29/01/18
 * Time: 20:36
 */

namespace App\Helpers;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;

class CommentHelper
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * CommentHelper constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em) {
        $this->entityManager = $em;
        $this->commentRepository = $em->getRepository(Comment::class);
    }

    public function save() {

    }
}