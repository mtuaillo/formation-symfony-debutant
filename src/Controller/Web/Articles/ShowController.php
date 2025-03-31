<?php

namespace App\Controller\Web\Articles;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShowController extends AbstractController
{
    #[Route('/articles/show/{id}', name: 'articles_show')]
    public function show(Article $article): Response
    {
        return $this->render('web/articles/show.html.twig', [
            'article' => $article,
        ]);
    }
}
