<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240521194706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create user table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE user (
          id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
          email VARCHAR(180) NOT NULL,
          roles CLOB NOT NULL --(DC2Type:json)
          ,
          PASSWORD VARCHAR(255) NOT NULL
        )');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user');
    }
}
