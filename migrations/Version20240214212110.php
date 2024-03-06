<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214212110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert initial data for users';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO \"user\" (id,email, password) VALUES (1,'user1@example.com', '" . password_hash('password1', PASSWORD_DEFAULT) . "');");
        $this->addSql("INSERT INTO \"user\" (id,email, password) VALUES (2,'user2@example.com', '" . password_hash('password2', PASSWORD_DEFAULT) . "');");
        $this->addSql("INSERT INTO \"user\" (id,email, password) VALUES (3,'user3@example.com', '" . password_hash('password3', PASSWORD_DEFAULT) . "');");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM user WHERE email IN ('user1@example.com', 'user2@example.com', 'user3@example.com');");
    }
}
