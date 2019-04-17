<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190417180517 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE blog.posts ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog.posts ADD CONSTRAINT FK_B8CC2756F675F31B FOREIGN KEY (author_id) REFERENCES blog.users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B8CC2756F675F31B ON blog.posts (author_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE blog.posts DROP CONSTRAINT FK_B8CC2756F675F31B');
        $this->addSql('DROP INDEX IDX_B8CC2756F675F31B');
        $this->addSql('ALTER TABLE blog.posts DROP author_id');
    }
}
