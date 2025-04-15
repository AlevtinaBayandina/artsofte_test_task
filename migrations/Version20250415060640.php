<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250415060640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE program (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE request (id SERIAL NOT NULL, program_id INT NOT NULL, car_id INT NOT NULL, initial_payment INT NOT NULL, loan_term INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3B978F9F3EB8070A ON request (program_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3B978F9FC3C6F69F ON request (car_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE request ADD CONSTRAINT FK_3B978F9F3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE request ADD CONSTRAINT FK_3B978F9FC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE request DROP CONSTRAINT FK_3B978F9F3EB8070A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE request DROP CONSTRAINT FK_3B978F9FC3C6F69F
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE program
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE request
        SQL);
    }
}
