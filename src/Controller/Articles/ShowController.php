<?php

namespace App\Controller\Articles;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShowController extends AbstractController
{
    #[Route('/articles/show/{id}', name: 'articles_show')]
    public function index(Article $article): Response
    {
        return $this->render('articles/show/index.html.twig', [
            'article' => $article,
        ]);
    }
}
