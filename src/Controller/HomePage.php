<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomePage extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
//        return $this->render('pages/homepage.html.twig');
    }
}