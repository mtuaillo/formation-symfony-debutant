<?php

namespace App\Command;

use App\Entity\Article;
use App\Repository\UserRepository;
use App\Services\Article\ArticleManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:articles:create',
    description: 'Create a new article',
)]
class CreateArticleCommand extends Command
{
    public function __construct(
        private ArticleManager $articleManager,
        private UserRepository $userRepository,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('title', InputArgument::REQUIRED, 'Title, required')
            ->addArgument('content', InputArgument::REQUIRED, 'Content, required')
            ->addArgument('email', InputArgument::REQUIRED, 'Author\'s email, required')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $title = $input->getArgument('title');
        $content = $input->getArgument('content');

        try {
            $author = $this->userRepository->findOneBy(['email' => $input->getArgument('email')]);

            $article = new Article();
            $article
                ->setTitle($title)
                ->setContent($content);

            $this->articleManager->create($article, $author);

            $io->success('Article créé avec succès !');
        } catch (\Exception $exception) {
            dump($exception);
        }

        return Command::SUCCESS;
    }
}
