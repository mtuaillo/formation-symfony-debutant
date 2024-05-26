<?php

namespace App\Controller\Articles;

use App\Entity\Article;
use App\Form\CreateArticleType;
use App\Security\Voter\ArticleEditVoter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EditController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/articles/edit/{id}', name: 'articles_edit', methods: ['GET', 'POST'])]
    #[IsGranted(ArticleEditVoter::EDIT, 'article')]
    public function index(Request $request, Article $article): Response
    {
        $form = $this->createForm(CreateArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            // Envoie les modifications sur toutes les entités en base de données
            $this->entityManager->flush();

            return $this->redirectToRoute('articles_list');
        }

        dump($form->getErrors());

        return $this->render('articles/create/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
