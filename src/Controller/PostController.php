<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25.01.2018
 * Time: 21:23
 */

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Post;
use App\Form\CommentsType;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function showAll()
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repo->findBy([], ['data'=> 'DESC'], 3);

        return $this->render('default/index.html.twig', ['posts' => $posts]);
    }


    /**
     * @Route("/post/{id}", name="postOne")
     *
     */
    public function showOne(Post $post)
    {
        return $this->render('post/index.html.twig', ['post' => $post]);
    }


    /**
     * @Route("/add", name="add_post")
     */
    public function addPost(Request $request, EntityManagerInterface $em)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($post);
            $em->flush();
            $id = $post->getId();
            $this->addFlash('info', 'Пост добавлен!');

            return $this->redirectToRoute('postOne', ['id'=>$id]);
        }

        return $this->render('post/add.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/redact/{id}", name="redact")
     */
    public function redact(Post $post, Request $request, EntityManagerInterface $em)
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($post);
            $em->flush();
            $id = $post->getId();
            $this->addFlash('info', 'Пост исправлен!');

            return $this->redirectToRoute('postOne', ['id'=>$id]);
        }

        return $this->render('post/redact.html.twig',
            ['form' => $form->createView(), 'post' => $post]);
    }

     /**
     * @Route("/addComm/{id}", name="add_comm")
     */
     public function addComm(Post $post, Request $request, EntityManagerInterface $em)
    {
        $comm = new Comments();
        $comm->setPost($post);
        $form = $this->createForm(CommentsType::class, $comm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($comm);
            $em->flush();
            $id = $comm->getId();
            $this->addFlash('comm', 'Комментарий добавлен!');

            return $this->redirectToRoute('postOne', ['id'=>$post->getId()]);
        }

        return $this->render('post/addComm.html.twig', ['form' => $form->createView()]);
    }

}