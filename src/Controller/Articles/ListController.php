<?php

namespace App\Controller\Articles;

use App\Repository\ArticleRepository;
use App\Services\ExporterWithUse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListController extends AbstractController
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
    ) {
    }

    #[Route('/articles/list', name: 'articles_list', methods: ['GET'])]
    public function index(): Response
    {
        $articles = $this->articleRepository->findAllWithTitleContaining('php');

        $articles = $this->articleRepository->findAll();

        return $this->render('articles/list/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
