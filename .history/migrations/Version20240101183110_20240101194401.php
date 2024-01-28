<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

 function up(Schema $schema): void
{
    // Insérer des données dans la table 'publisher'
    $this->addSql("INSERT INTO publisher (name, address) VALUES ('Éditions Gallimard', 'Paris, France');");

    // Insérer des données dans la table 'author'
    $this->addSql("INSERT INTO author (name, bio) VALUES ('Antoine de Saint-Exupéry', 'Biographie de l\'auteur');");

    // Insérer des données dans la table 'category'
    $this->addSql("INSERT INTO category (name, description) VALUES ('Fiction', 'Livres de fiction');");

    // Insérer des données dans la table 'book'
    $this->addSql("INSERT INTO book (title, author_id, isbn, published_date, publisher_id, category_id) VALUES ('Le Petit Prince', (SELECT id FROM author WHERE name = 'Antoine de Saint-Exupéry'), '978-3-16-148410-0', '1943-04-06', (SELECT id FROM publisher WHERE name = 'Éditions Gallimard'), (SELECT id FROM category WHERE name = 'Fiction'));");
}

function down(Schema $schema): void
{
    // Supprimer des données de la table 'book'
    $this->addSql("DELETE FROM book WHERE title = 'Le Petit Prince';");

    // Supprimer des données des tables 'author', 'category', et 'publisher'
    $this->addSql("DELETE FROM author WHERE name = 'Antoine de Saint-Exupéry';");
    $this->addSql("DELETE FROM category WHERE name = 'Fiction';");
    $this->addSql("DELETE FROM publisher WHERE name = 'Éditions Gallimard';");
}

