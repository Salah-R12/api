<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240213163903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE author_id_seq');
        $this->addSql('SELECT setval(\'author_id_seq\', (SELECT MAX(id) FROM author))');
        $this->addSql('ALTER TABLE author ALTER id SET DEFAULT nextval(\'author_id_seq\')');
        $this->addSql('CREATE SEQUENCE book_id_seq');
        $this->addSql('SELECT setval(\'book_id_seq\', (SELECT MAX(id) FROM book))');
        $this->addSql('ALTER TABLE book ALTER id SET DEFAULT nextval(\'book_id_seq\')');
        $this->addSql('ALTER TABLE book ALTER publisher_id SET NOT NULL');
        $this->addSql('CREATE SEQUENCE category_id_seq');
        $this->addSql('SELECT setval(\'category_id_seq\', (SELECT MAX(id) FROM category))');
        $this->addSql('ALTER TABLE category ALTER id SET DEFAULT nextval(\'category_id_seq\')');
        $this->addSql('CREATE SEQUENCE publisher_id_seq');
        $this->addSql('SELECT setval(\'publisher_id_seq\', (SELECT MAX(id) FROM publisher))');
        $this->addSql('ALTER TABLE publisher ALTER id SET DEFAULT nextval(\'publisher_id_seq\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE publisher ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE author ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE category ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE book ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE book ALTER publisher_id DROP NOT NULL');
    }
}
