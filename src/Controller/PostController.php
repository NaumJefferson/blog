<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;


/**
 * @Route("/posts", name="post_")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();
        return $this->render('post/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $post->setCreatedAt(new \DateTime('now', new \DateTimeZone('America/Recife')));
            $post->setUpdatedAt(new \DateTime('now', new \DateTimeZone('America/Recife')));

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $this->addFlash("success", "Post criado com sucesso");

            return $this->redirectToRoute('post_index');
        }

        return $this->render('post/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Request $request, $id)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $post->setUpdatedAt(new \DateTime('now', new \DateTimeZone('America/Recife')));
            
            $em = $this->getDoctrine()->getManager();
            $em->flush();
    
            $this->addFlash("success", "Post atualizado com sucesso");
    
            return $this->redirectToRoute('post_index');
        }

        return $this->render('post/edit.html.twig', [
            'form' => $form->createView(),
            'post' => $post
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove($id){
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        $this->addFlash("success", "Post removido com sucesso");
        return $this->redirectToRoute('post_index');
    }


}
