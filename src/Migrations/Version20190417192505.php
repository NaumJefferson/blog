<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190417192505 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE blog.post_category (post_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(post_id, category_id))');
        $this->addSql('CREATE INDEX IDX_BD47083FA76ED395 ON blog.post_category (post_id)');
        $this->addSql('CREATE INDEX IDX_BD47083F12469DE2 ON blog.post_category (category_id)');
        $this->addSql('ALTER TABLE blog.post_category ADD CONSTRAINT FK_BD47083FA76ED395 FOREIGN KEY (post_id) REFERENCES blog.posts (codigo) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog.post_category ADD CONSTRAINT FK_BD47083F12469DE2 FOREIGN KEY (category_id) REFERENCES blog.categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE blog.post_category');
    }
}
