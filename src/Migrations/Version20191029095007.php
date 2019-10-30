<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191029095007 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, price INT NOT NULL, stock TINYINT(1) NOT NULL, brand VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');

        $this->addSql('INSERT INTO product(id, brand, title, price, stock) VALUES (1, "Puma", "test product", 50, true)');
        $this->addSql('INSERT INTO product(id, brand, title, price, stock) VALUES (2, "Calvin Klein", "jeans", 100, true)');
        $this->addSql('INSERT INTO product(id, brand, title, price, stock) VALUES (3, "Puma", "slim jeans", 200, true)');
        $this->addSql('INSERT INTO product(id, brand, title, price, stock) VALUES (4, "Adidas", "slim hemd", 50, false)');
        $this->addSql('INSERT INTO product(id, brand, title, price, stock) VALUES (5, "Puma", "sport shoes", 250, false)');
        $this->addSql('INSERT INTO product(id, brand, title, price, stock) VALUES (6, "Calvin Klein", "slim jeans", 30, true)');
        $this->addSql('INSERT INTO product(id, brand, title, price, stock) VALUES (7, "Adidas", "shoes", 500, true)');
        $this->addSql('INSERT INTO product(id, brand, title, price, stock) VALUES (8, "Nike", "test shoes", 1000, true)');
        $this->addSql('INSERT INTO product(id, brand, title, price, stock) VALUES (9, "Nike", "jacke", 1000, true)');
        $this->addSql('INSERT INTO product(id, brand, title, price, stock) VALUES (10, "Nike", "sport jacke", 1000, true)');
        $this->addSql('INSERT INTO product(id, brand, title, price, stock) VALUES (11, "Test", "abc", 5, true)');
        $this->addSql('INSERT INTO product(id, brand, title, price, stock) VALUES (12, "Test", "bc", 2, true)');
        $this->addSql('INSERT INTO product(id, brand, title, price, stock) VALUES (13, "Test1", "abcd", 1, true)');
        $this->addSql('INSERT INTO product(id, brand, title, price, stock) VALUES (14, "Test1", "cbd", 250, true)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE product');
    }
}
