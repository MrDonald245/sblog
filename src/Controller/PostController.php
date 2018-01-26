<?php

namespace App\Controller;

use App\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * @Route("/post/{post}", name="post_show")
     *
     * @param Post $post
     * @return Response
     */
    public function showAction(Post $post): Response {
        return $this->render('post/show.html.twig', ['post' => $post]);
    }

    /**
     * @Route("/new-post", name="post_create")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(): Response {
        return $this->render('post/create.html.twig');
    }

    /**
     * @Route("post/edit/{post}", name="post_edit")
     *
     * @param Post $post
     * @param Request $request
     * @return Response
     */
    public function editAction(Post $post, Request $request): Response {
        return $this->render('post/edit.html.twig', ['post' => $post]);
    }

    /**
     * @Route("/post/delete/{post}", name="post_delete")
     *
     * @param Post $post
     * @return Response
     */
    public function deleteAction(Post $post): Response {
        return $this->redirect($this->generateUrl('home'));
    }
}
