<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210408163719 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create phone_book table';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE `phone_book` (`id` BINARY(32) PRIMARY KEY, `first_name` VARCHAR(256) NOT NULL, `last_name` VARCHAR(256) DEFAULT NULL, `phone_number` VARCHAR(64) NOT NULL, `country_code` VARCHAR(64) DEFAULT NULL, `timezone_name` VARCHAR(64) DEFAULT NULL, `inserted_on` DATETIME NOT NULL, `updated_on` DATETIME NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE `phone_book`');
    }
}
