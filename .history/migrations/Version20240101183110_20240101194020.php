<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
public function up(Schema $schema): void
{
    // Insérer des données dans la table 'publisher'
    $this->addSql("INSERT INTO publisher (name, address) VALUES ('Éditions Gallimard', 'Paris, France');");

    // Insérer des données dans la table 'book'
    $this->addSql("INSERT INTO book (title, author, isbn, published_date, publisher_id) VALUES ('Le Petit Prince', 'Antoine de Saint-Exupéry', '978-3-16-148410-0', '1943-04-06', (SELECT id FROM publisher WHERE name = 'Éditions Gallimard'));");
}


    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
