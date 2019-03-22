<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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

}

