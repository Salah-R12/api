<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240101185347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Insérer des données dans la table 'publisher' avec ID
        $this->addSql("INSERT INTO publisher (id, name, address) VALUES (1, 'Éditions Gallimard', 'Paris, France');");
    
        // Insérer des données dans la table 'author' avec ID
        $this->addSql("INSERT INTO author (id, name, text) VALUES (1, 'Antoine de Saint-Exupéry', 'Biographie de lauteur');");
    
        // Insérer des données dans la table 'category' avec ID
        $this->addSql("INSERT INTO category (id, name, description) VALUES (1, 'Fiction', 'Livres de fiction');");
    
        // Insérer des données dans la table 'book'
        $this->addSql("INSERT INTO book (id,title, author_id, isbn, published_date, category_id) VALUES (1,'Le Petit Prince', 1, '978-3-16-148410-0', '1943-04-06', 1);");
    }
    
    public function down(Schema $schema): void
    {
        // Supprimer des données de la table 'book'
        $this->addSql("DELETE FROM book WHERE title = 'Le Petit Prince';");
    
        // Supprimer des données des tables 'author', 'category', et 'publisher'
        $this->addSql("DELETE FROM author WHERE id = 1;");
        $this->addSql("DELETE FROM category WHERE id = 1;");
        $this->addSql("DELETE FROM publisher WHERE id = 1;");
    }
}
