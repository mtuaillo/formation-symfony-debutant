<?php

namespace App\Controller\Articles;

use App\Form\CreateArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CreateController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/articles/create', name: 'articles_create', methods: ['GET', 'POST'])]
    // #[IsGranted("ROLE_ADMIN")]
    public function index(Request $request): Response
    {
        $form = $this->createForm(CreateArticleType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            // Indique à Doctrine de gérer cette nouvelle entité
            $this->entityManager->persist($article);

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
