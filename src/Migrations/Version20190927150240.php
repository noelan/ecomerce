<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190927150240 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cloth_material (cloth_id INT NOT NULL, material_id INT NOT NULL, INDEX IDX_D7340247E53266EE (cloth_id), INDEX IDX_D7340247E308AC6F (material_id), PRIMARY KEY(cloth_id, material_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cloth_size (cloth_id INT NOT NULL, size_id INT NOT NULL, INDEX IDX_FA81CDC1E53266EE (cloth_id), INDEX IDX_FA81CDC1498DA827 (size_id), PRIMARY KEY(cloth_id, size_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cloth_material ADD CONSTRAINT FK_D7340247E53266EE FOREIGN KEY (cloth_id) REFERENCES cloth (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cloth_material ADD CONSTRAINT FK_D7340247E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cloth_size ADD CONSTRAINT FK_FA81CDC1E53266EE FOREIGN KEY (cloth_id) REFERENCES cloth (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cloth_size ADD CONSTRAINT FK_FA81CDC1498DA827 FOREIGN KEY (size_id) REFERENCES size (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE cloth_material');
        $this->addSql('DROP TABLE cloth_size');
    }
}
