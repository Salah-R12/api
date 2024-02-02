<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240130185347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Assign default publisher to existing books';
    }

    public function up(Schema $schema): void
    {
        // Insérer un éditeur par défaut si non existant
        $this->addSql("INSERT INTO publisher (id, name, address) SELECT 1, 'Expo publisher', '11 rue etienne deforges , paris12' WHERE NOT EXISTS (SELECT id FROM publisher WHERE id = 1);");

        // Mettre à jour les enregistrements existants dans la table 'book' pour assigner l'éditeur par défaut
        $this->addSql("UPDATE book SET publisher_id = 1 WHERE publisher_id IS NULL;");
    }

    public function down(Schema $schema): void
    {
        // Réinitialiser la colonne publisher_id dans la table 'book'
        $this->addSql("UPDATE book SET publisher_id = NULL WHERE publisher_id = 1;");

        // Optionnel : Supprimer l'éditeur par défaut
        // $this->addSql("DELETE FROM publisher WHERE id = 1;");
    }
}
