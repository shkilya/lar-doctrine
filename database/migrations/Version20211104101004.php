<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20211104101004 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE auth_users (id INT NOT NULL, email VARCHAR(255) NOT NULL, password_hash VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, created_at DATE NOT NULL, registrationToken_value VARCHAR(255) DEFAULT NULL, registrationToken_expires TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN auth_users.status IS \'(DC2Type:user_status)\'');
        $this->addSql('COMMENT ON COLUMN auth_users.created_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN auth_users.registrationToken_expires IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE permissions (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE permission_role (permission_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(permission_id, role_id))');
        $this->addSql('CREATE INDEX IDX_6A711CAFED90CCA ON permission_role (permission_id)');
        $this->addSql('CREATE INDEX IDX_6A711CAD60322AC ON permission_role (role_id)');
        $this->addSql('CREATE TABLE roles (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE permission_role ADD CONSTRAINT FK_6A711CAFED90CCA FOREIGN KEY (permission_id) REFERENCES permissions (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE permission_role ADD CONSTRAINT FK_6A711CAD60322AC FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE permission_role DROP CONSTRAINT FK_6A711CAFED90CCA');
        $this->addSql('ALTER TABLE permission_role DROP CONSTRAINT FK_6A711CAD60322AC');
        $this->addSql('DROP TABLE auth_users');
        $this->addSql('DROP TABLE permissions');
        $this->addSql('DROP TABLE permission_role');
        $this->addSql('DROP TABLE roles');
    }
}
