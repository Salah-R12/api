<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240101185347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Insérer des données dans la table 'publisher'
        $this->addSql("INSERT INTO publisher (name, address) VALUES ('Éditions Gallimard', 'Paris, France');");
    
        // Insérer des données dans la table 'author'
        $this->addSql("INSERT INTO author (name, bio) VALUES ('Antoine de Saint-Exupéry', 'Biographie de l\'auteur');");
    
        // Insérer des données dans la table 'category'
        $this->addSql("INSERT INTO category (name, description) VALUES ('Fiction', 'Livres de fiction');");
    
        
    }
    
    public function down(Schema $schema): void
    {
        
    
        // Supprimer des données des tables 'author', 'category', et 'publisher'
        $this->addSql("DELETE FROM author WHERE name = 'Antoine de Saint-Exupéry';");
        $this->addSql("DELETE FROM category WHERE name = 'Fiction';");
        $this->addSql("DELETE FROM publisher WHERE name = 'Éditions Gallimard';");
    }
    
}
