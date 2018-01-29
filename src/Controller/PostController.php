<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use App\Form\PostType;
use App\Helpers\PostHelper;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * @var PostHelper
     */
    private $postHelper;

    /**
     * PostController constructor.
     * @param PostHelper $postHelper
     */
    public function __construct(PostHelper $postHelper) {
        $this->postHelper = $postHelper;
    }

    /**
     * @Route("/post/{post}", name="post_show")
     *
     * @param Post $post
     * @param Request $request
     * @return Response
     */
    public function showAction(Post $post, Request $request): Response {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $post->addComment($comment);
            $this->postHelper->save($post);

            return $this->redirectToRoute('post_show', ['post' => $post->getId()]);
        }

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new-post", name="post_create")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request): Response {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $this->postHelper->save($post);

            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('post/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("post/edit/{post}", name="post_edit")
     *
     * @param Post $post
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function editAction(Post $post, Request $request, EntityManagerInterface $em): Response {
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('post_show', ['post' => $post->getId()]));
        }

        return $this->render('post/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/post/delete/{post}", name="post_delete")
     *
     * @param Post $post
     * @return Response
     */
    public function deleteAction(Post $post): Response {
        $this->postHelper->remove($post);
        return $this->redirect($this->generateUrl('home'));
    }
}
