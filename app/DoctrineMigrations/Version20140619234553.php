<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20140619234553 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql");
        
        $this->addSql("ALTER TABLE product ADD productCategory_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE product ADD CONSTRAINT FK_1CF73D3164F6BD66 FOREIGN KEY (productCategory_id) REFERENCES ProductCategory (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("CREATE INDEX IDX_1CF73D3164F6BD66 ON product (productCategory_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql");
        
        $this->addSql("ALTER TABLE Product DROP CONSTRAINT FK_1CF73D3164F6BD66");
        $this->addSql("DROP INDEX IDX_1CF73D3164F6BD66");
        $this->addSql("ALTER TABLE Product DROP productCategory_id");
    }
}