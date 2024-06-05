<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240615132835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add slug and author columns to articles';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, title, content FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (
          id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
          author_id INTEGER NOT NULL,
          title VARCHAR(255) NOT NULL,
          content CLOB NOT NULL,
          slug VARCHAR(255) NOT NULL,
          CONSTRAINT FK_23A0E66F675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        )');
        $this->addSql('INSERT INTO article (id, title, content) SELECT id, title, content FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E66F675F31B ON article (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, title, content FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (
          id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
          title VARCHAR(255) NOT NULL,
          content CLOB NOT NULL
        )');
        $this->addSql('INSERT INTO article (id, title, content) SELECT id, title, content FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
    }
}
