<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Form\UserType;


/**
     * @Route("/users", name="user_")
     */
class UserController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index(){
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('user/index.html.twig',[
            'users' => $users
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $user->setCreatedAt(new \DateTime('now', new \DateTimeZone('America/Recife')));
            $user->setUpdatedAt(new \DateTime('now', new \DateTimeZone('America/Recife')));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Usuário criado com sucesso!');
            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Request $request, $id){
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $user->setUpdatedAt(new \DateTime('now', new \DateTimeZone('America/Recife')));

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Usuário atualizado com sucesso!');
            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'Usuário removido com sucesso!');
        return $this->redirectToRoute('user_index');
    }



}
