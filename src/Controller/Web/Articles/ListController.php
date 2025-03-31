<?php

namespace App\Controller\Web\Articles;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

class ListController extends AbstractController
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
        private Environment $twig,
    ) {
    }

    #[Route('/articles/list', name: 'articles_list', methods: ['GET'])]
    public function list(): Response
    {
        $articles = $this->articleRepository->findAllWithTitleContaining('php');

        $articles = $this->articleRepository->findAll();

        $html = $this->twig->render('web/articles/list.html.twig', [
            'articles' => $articles,
        ]);

        return new Response($html);
    }
}
