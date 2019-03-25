<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{

    /** 
     * @Route("/")
    */
    public function index()
    {
        return $this->render('Default\index.html.twig', ['title'=>'Home']);
    }

    /**
     * @Route("/posts/{slug}")
     */
    public function single($slug){
        return $this->render('Default\single.html.twig', compact('slug'));
    }

}

