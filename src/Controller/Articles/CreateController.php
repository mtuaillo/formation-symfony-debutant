<?php

namespace App\Controller\Articles;

use App\Form\CreateArticleType;
use App\Services\Article\ArticleManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class CreateController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ArticleManager $articleManager,
    ) {
    }

    #[Route('/articles/create', name: 'articles_create', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        #[CurrentUser] $currentUser
    ): Response {
        $form = $this->createForm(CreateArticleType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            // Indique à Doctrine de gérer cette nouvelle entité
            $this->entityManager->persist($article);

            // Envoie les modifications sur toutes les entités en base de données
            $this->entityManager->flush();

            $this->articleManager->create($article, $currentUser);

            return $this->redirectToRoute('articles_list');
        }

        return $this->render('articles/create/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
