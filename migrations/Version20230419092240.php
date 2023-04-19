<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230419092240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE record (id INT AUTO_INCREMENT NOT NULL, unique_key VARCHAR(255) NOT NULL, is_draft TINYINT(1) NOT NULL, is_moderated TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE record_photos (id INT AUTO_INCREMENT NOT NULL, record_id_id INT NOT NULL, photo_name VARCHAR(255) NOT NULL, photo_url_name VARCHAR(255) NOT NULL, photo_media_path VARCHAR(512) NOT NULL, INDEX IDX_6A2AA6A7FE1F3F0B (record_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE record_text (id INT AUTO_INCREMENT NOT NULL, record_id_id INT NOT NULL, lang_code VARCHAR(3) NOT NULL, body_html LONGTEXT NOT NULL, INDEX IDX_DE3C3613FE1F3F0B (record_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(256) NOT NULL, ip_address VARCHAR(15) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, birth_date DATE DEFAULT NULL, is_admin TINYINT(1) DEFAULT NULL, blocked TINYINT(1) DEFAULT NULL, browser_info VARCHAR(1000) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE record_photos ADD CONSTRAINT FK_6A2AA6A7FE1F3F0B FOREIGN KEY (record_id_id) REFERENCES record (id)');
        $this->addSql('ALTER TABLE record_text ADD CONSTRAINT FK_DE3C3613FE1F3F0B FOREIGN KEY (record_id_id) REFERENCES record (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE record_photos DROP FOREIGN KEY FK_6A2AA6A7FE1F3F0B');
        $this->addSql('ALTER TABLE record_text DROP FOREIGN KEY FK_DE3C3613FE1F3F0B');
        $this->addSql('DROP TABLE record');
        $this->addSql('DROP TABLE record_photos');
        $this->addSql('DROP TABLE record_text');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
