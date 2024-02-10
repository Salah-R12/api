<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240209173418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Fill price fields with random values between 20 and 100 for all books.';
    }

    public function up(Schema $schema): void
    {
        // Met à jour les prix avec des valeurs aléatoires entre 20 et 100
        $this->addSql("UPDATE book SET price = ROUND((RANDOM() * (100 - 20) + 20)::numeric, 2)");
    }

    public function down(Schema $schema): void
    {
        // Option pour réinitialiser tous les prix à NULL lors du rollback
        $this->addSql('UPDATE book SET price = NULL');
    }
}
