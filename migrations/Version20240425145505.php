<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240425145505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, 
                                            name VARCHAR(255) NOT NULL, 
                                            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, 
                                            name VARCHAR(255) NOT NULL, 
                                            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, 
                                        responsible_id INT NOT NULL, 
                                        created_by_id INT NOT NULL, 
                                        squad_id INT NOT NULL, 
                                        title VARCHAR(255) NOT NULL, 
                                        description LONGTEXT NOT NULL, 
                                        start_date VARCHAR(255) NOT NULL, 
                                        end_date DATE NOT NULL, 
                                        INDEX IDX_527EDB25602AD315 (responsible_id), 
                                        INDEX IDX_527EDB25B03A8386 (created_by_id), 
                                        INDEX IDX_527EDB25DF1B2C7C (squad_id), 
                                        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25602AD315 FOREIGN KEY (responsible_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25B03A8386 FOREIGN KEY (created_by_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25DF1B2C7C FOREIGN KEY (squad_id) REFERENCES `group` (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25602AD315');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25B03A8386');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25DF1B2C7C');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE task');
    }
}
