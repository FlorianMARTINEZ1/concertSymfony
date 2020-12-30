<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201226223329 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(25) NOT NULL, last_name VARCHAR(25) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE show_band');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE show_band (show_id INT NOT NULL, band_id INT NOT NULL, INDEX IDX_94287428D0C1FC64 (show_id), INDEX IDX_9428742849ABEB17 (band_id), PRIMARY KEY(show_id, band_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE show_band ADD CONSTRAINT FK_9428742849ABEB17 FOREIGN KEY (band_id) REFERENCES band (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE show_band ADD CONSTRAINT FK_94287428D0C1FC64 FOREIGN KEY (show_id) REFERENCES showlist (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user');
    }
}
