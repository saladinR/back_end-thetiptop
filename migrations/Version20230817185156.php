<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230817185156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tickets (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, gain_id INT NOT NULL, numero VARCHAR(10) NOT NULL, utilise TINYINT(1) NOT NULL, INDEX IDX_54469DF419EB6921 (client_id), INDEX IDX_54469DF4C60EF8C4 (gain_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF419EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF4C60EF8C4 FOREIGN KEY (gain_id) REFERENCES gains (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF419EB6921');
        $this->addSql('ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF4C60EF8C4');
        $this->addSql('DROP TABLE tickets');
    }
}
