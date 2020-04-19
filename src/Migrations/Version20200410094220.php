<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200410094220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE tv_show_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE movie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tv_season_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tv_episode_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE torrent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tv_show (id INT NOT NULL, id_tmdb INT NOT NULL, title VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE movie (id INT NOT NULL, id_tmdb INT NOT NULL, title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tv_season (id INT NOT NULL, tv_show_id INT NOT NULL, number INT NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B5C27D345E3A35BB ON tv_season (tv_show_id)');
        $this->addSql('CREATE TABLE tv_episode (id INT NOT NULL, season_id INT NOT NULL, show_id INT NOT NULL, number INT NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5351D5054EC001D1 ON tv_episode (season_id)');
        $this->addSql('CREATE INDEX IDX_5351D505D0C1FC64 ON tv_episode (show_id)');
        $this->addSql('CREATE TABLE torrent (id INT NOT NULL, hash VARCHAR(255) NOT NULL, media_type VARCHAR(255) NOT NULL, completed BOOLEAN NOT NULL, tag VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE tv_season ADD CONSTRAINT FK_B5C27D345E3A35BB FOREIGN KEY (tv_show_id) REFERENCES tv_show (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tv_episode ADD CONSTRAINT FK_5351D5054EC001D1 FOREIGN KEY (season_id) REFERENCES tv_season (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tv_episode ADD CONSTRAINT FK_5351D505D0C1FC64 FOREIGN KEY (show_id) REFERENCES tv_show (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tv_season DROP CONSTRAINT FK_B5C27D345E3A35BB');
        $this->addSql('ALTER TABLE tv_episode DROP CONSTRAINT FK_5351D505D0C1FC64');
        $this->addSql('ALTER TABLE tv_episode DROP CONSTRAINT FK_5351D5054EC001D1');
        $this->addSql('DROP SEQUENCE tv_show_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE movie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tv_season_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tv_episode_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE torrent_id_seq CASCADE');
        $this->addSql('DROP TABLE tv_show');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE tv_season');
        $this->addSql('DROP TABLE tv_episode');
        $this->addSql('DROP TABLE torrent');
    }
}
