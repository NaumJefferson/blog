<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Post;

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
    public function create()
    {
        return $this->render('post/create.html.twig');
    }

    /**
     * @Route("/save", name="save")
     */
    public function save(Request $request)
    {
        $data = $request->request->all();

        $post = new Post();
        $post->setTitulo($data['titulo']);
        $post->setDescricao($data['descricao']);
        $post->setSlug($data['slug']);
        $post->setConteudo($data['conteudo']);
        $post->setCreatedAt(new \DateTime('now', new \DateTimeZone('America/Recife')));
        $post->setUpdatedAt(new \DateTime('now', new \DateTimeZone('America/Recife')));

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        $this->addFlash("success", "Post criado com sucesso");

        return $this->redirectToRoute('post_index');
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit($id)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        return $this->render('post/edit.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/update/{id}", name="update")
     */
    public function update(Request $request, $id)
    {
        $data = $request->request->all();
        
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        $post->setTitulo($data['titulo']);
        $post->setDescricao($data['descricao']);
        $post->setSlug($data['slug']);
        $post->setConteudo($data['conteudo']);
        $post->setUpdatedAt(new \DateTime('now', new \DateTimeZone('America/Recife')));

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $this->addFlash("success", "Post atualizado com sucesso");

        return $this->redirectToRoute('post_index');
    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remover($id){
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        $this->addFlash("success", "Post removido com sucesso");
        return $this->redirectToRoute('post_index');
    }


}
