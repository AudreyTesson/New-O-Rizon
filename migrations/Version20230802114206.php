<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230802114206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city_user (city_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6EDDEB218BAC62AF (city_id), INDEX IDX_6EDDEB21A76ED395 (user_id), PRIMARY KEY(city_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE city_user ADD CONSTRAINT FK_6EDDEB218BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE city_user ADD CONSTRAINT FK_6EDDEB21A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review ADD city_id INT NOT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C68BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_794381C68BAC62AF ON review (city_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city_user DROP FOREIGN KEY FK_6EDDEB218BAC62AF');
        $this->addSql('ALTER TABLE city_user DROP FOREIGN KEY FK_6EDDEB21A76ED395');
        $this->addSql('DROP TABLE city_user');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C68BAC62AF');
        $this->addSql('DROP INDEX IDX_794381C68BAC62AF ON review');
        $this->addSql('ALTER TABLE review DROP city_id');
    }
}
