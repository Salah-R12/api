<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240201215346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert initial data for books and related entities';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DELETE FROM book;');
        $this->addSql('DELETE FROM author;');
        $this->addSql('DELETE FROM category;');
        $this->addSql('DELETE FROM publisher;');

        // Insérer des données dans la table 'publisher'
        for ($i = 1; $i <= 3; $i++) {
            $this->addSql("INSERT INTO publisher (id, name, address) VALUES ($i, 'Publisher $i', 'Address $i');");
        }

        // Insérer des données dans la table 'author'
        for ($i = 1; $i <= 5; $i++) {
            $this->addSql("INSERT INTO author (id, name, text) VALUES ($i, 'Author $i', 'Bio of Author $i');");
        }

        // Insérer des données dans la table 'category'
        for ($i = 1; $i <= 4; $i++) {
            $this->addSql("INSERT INTO category (id, name, description) VALUES ($i, 'Category $i', 'Description for Category $i');");
        }

        // Insérer des données dans la table 'book'
        for ($i = 1; $i <= 10; $i++) {
            $publisherId = ($i % 3) + 1;  // Assign a publisher (1 to 3)
            $authorId = ($i % 5) + 1;      // Assign an author (1 to 5)
            $categoryId = ($i % 4) + 1;    // Assign a category (1 to 4)
            $isbn = "978-3-16-148410-$i";
            $publishedDate = date('Y-m-d', strtotime("-$i year"));

            $this->addSql("INSERT INTO book (id, title, isbn, published_date, author_id, category_id, publisher_id) VALUES ($i, 'Book $i', '$isbn', '$publishedDate', $authorId, $categoryId, $publisherId);");
        }
    }

    public function down(Schema $schema): void
    {
        // Supprimer les données insérées lors du rollback
        $this->addSql('DELETE FROM book;');
        $this->addSql('DELETE FROM author;');
        $this->addSql('DELETE FROM category;');
        $this->addSql('DELETE FROM publisher;');
    }
}
