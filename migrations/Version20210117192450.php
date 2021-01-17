<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210117192450 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_post (id INT AUTO_INCREMENT NOT NULL, blog_post_category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, deprecated_at DATETIME NOT NULL, flag VARCHAR(255) NOT NULL, blog_post_image VARCHAR(255) NOT NULL, INDEX IDX_BA5AE01D8A053C2B (blog_post_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_post_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_post_comment (id INT AUTO_INCREMENT NOT NULL, blog_post_id INT DEFAULT NULL, content LONGTEXT NOT NULL, enabled VARCHAR(255) NOT NULL, INDEX IDX_F3400AD8A77FBEAF (blog_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio_images (id INT AUTO_INCREMENT NOT NULL, portfolio_project_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_E6F4535F244BDBEE (portfolio_project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio_project (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, link LONGTEXT NOT NULL, client VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, INDEX IDX_7906FF2012469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01D8A053C2B FOREIGN KEY (blog_post_category_id) REFERENCES blog_post_category (id)');
        $this->addSql('ALTER TABLE blog_post_comment ADD CONSTRAINT FK_F3400AD8A77FBEAF FOREIGN KEY (blog_post_id) REFERENCES blog_post (id)');
        $this->addSql('ALTER TABLE portfolio_images ADD CONSTRAINT FK_E6F4535F244BDBEE FOREIGN KEY (portfolio_project_id) REFERENCES portfolio_project (id)');
        $this->addSql('ALTER TABLE portfolio_project ADD CONSTRAINT FK_7906FF2012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_post_comment DROP FOREIGN KEY FK_F3400AD8A77FBEAF');
        $this->addSql('ALTER TABLE blog_post DROP FOREIGN KEY FK_BA5AE01D8A053C2B');
        $this->addSql('ALTER TABLE portfolio_project DROP FOREIGN KEY FK_7906FF2012469DE2');
        $this->addSql('ALTER TABLE portfolio_images DROP FOREIGN KEY FK_E6F4535F244BDBEE');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE blog_post_category');
        $this->addSql('DROP TABLE blog_post_comment');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE portfolio_images');
        $this->addSql('DROP TABLE portfolio_project');
        $this->addSql('DROP TABLE user');
    }
}
