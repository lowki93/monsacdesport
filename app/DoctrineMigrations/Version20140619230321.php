<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20140619230321 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql");
        
        $this->addSql("CREATE SEQUENCE Commande_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE Image_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE Product_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE ProductCategory_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE fos_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE Commande (id INT NOT NULL, owner_id INT DEFAULT NULL, num_commande VARCHAR(255) NOT NULL, status VARCHAR(20) NOT NULL, sentAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_979CC42B7E3C61F9 ON Commande (owner_id)");
        $this->addSql("CREATE TABLE Image (id INT NOT NULL, product_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_4FC2B5B4584665A ON Image (product_id)");
        $this->addSql("CREATE TABLE Product (id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, createdAt DATE NOT NULL, updatedAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, description TEXT NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, brand VARCHAR(255) NOT NULL, size VARCHAR(255) NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_1CF73D31989D9B62 ON Product (slug)");
        $this->addSql("CREATE TABLE product_commande (product_id INT NOT NULL, commande_id INT NOT NULL, PRIMARY KEY(product_id, commande_id))");
        $this->addSql("CREATE INDEX IDX_A55ACCEA4584665A ON product_commande (product_id)");
        $this->addSql("CREATE INDEX IDX_A55ACCEA82EA2E54 ON product_commande (commande_id)");
        $this->addSql("CREATE TABLE ProductCategory (id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_D26EBFC4989D9B62 ON ProductCategory (slug)");
        $this->addSql("CREATE TABLE fos_user (id INT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locked BOOLEAN NOT NULL, expired BOOLEAN NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles TEXT NOT NULL, credentials_expired BOOLEAN NOT NULL, credentials_expire_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, first_name TEXT DEFAULT NULL, last_name TEXT DEFAULT NULL, address TEXT DEFAULT NULL, zipcode TEXT DEFAULT NULL, city TEXT DEFAULT NULL, phone TEXT DEFAULT NULL, complementary_info TEXT DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_957A647992FC23A8 ON fos_user (username_canonical)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_957A6479A0D96FBF ON fos_user (email_canonical)");
        $this->addSql("COMMENT ON COLUMN fos_user.roles IS '(DC2Type:array)'");
        $this->addSql("ALTER TABLE Commande ADD CONSTRAINT FK_979CC42B7E3C61F9 FOREIGN KEY (owner_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE Image ADD CONSTRAINT FK_4FC2B5B4584665A FOREIGN KEY (product_id) REFERENCES Product (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE product_commande ADD CONSTRAINT FK_A55ACCEA4584665A FOREIGN KEY (product_id) REFERENCES Product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE product_commande ADD CONSTRAINT FK_A55ACCEA82EA2E54 FOREIGN KEY (commande_id) REFERENCES Commande (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE");
    }

    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql");
        
        $this->addSql("ALTER TABLE product_commande DROP CONSTRAINT FK_A55ACCEA82EA2E54");
        $this->addSql("ALTER TABLE Image DROP CONSTRAINT FK_4FC2B5B4584665A");
        $this->addSql("ALTER TABLE product_commande DROP CONSTRAINT FK_A55ACCEA4584665A");
        $this->addSql("ALTER TABLE Commande DROP CONSTRAINT FK_979CC42B7E3C61F9");
        $this->addSql("DROP SEQUENCE Commande_id_seq CASCADE");
        $this->addSql("DROP SEQUENCE Image_id_seq CASCADE");
        $this->addSql("DROP SEQUENCE Product_id_seq CASCADE");
        $this->addSql("DROP SEQUENCE ProductCategory_id_seq CASCADE");
        $this->addSql("DROP SEQUENCE fos_user_id_seq CASCADE");
        $this->addSql("DROP TABLE Commande");
        $this->addSql("DROP TABLE Image");
        $this->addSql("DROP TABLE Product");
        $this->addSql("DROP TABLE product_commande");
        $this->addSql("DROP TABLE ProductCategory");
        $this->addSql("DROP TABLE fos_user");
    }
}