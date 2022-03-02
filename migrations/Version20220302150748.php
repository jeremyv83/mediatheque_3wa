<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220302150748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auteur_rencontre (auteur_id INT NOT NULL, rencontre_id INT NOT NULL, INDEX IDX_5CEB872760BB6FE6 (auteur_id), INDEX IDX_5CEB87276CFC0818 (rencontre_id), PRIMARY KEY(auteur_id, rencontre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, document_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, INDEX IDX_9474526CF675F31B (author_id), INDEX IDX_9474526CC33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, auteur_id INT DEFAULT NULL, document_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, quantity INT NOT NULL, physique TINYINT(1) NOT NULL, fragile TINYINT(1) NOT NULL, description VARCHAR(5000) NOT NULL, date DATE NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_D8698A7660BB6FE6 (auteur_id), INDEX IDX_D8698A7661232A4F (document_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emprunt (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, documents_id INT DEFAULT NULL, date_emprunt DATE NOT NULL, date_remise DATE DEFAULT NULL, etat_remise INT DEFAULT NULL, INDEX IDX_364071D7A76ED395 (user_id), INDEX IDX_364071D75F0F2752 (documents_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logs (id INT AUTO_INCREMENT NOT NULL, documents_id INT DEFAULT NULL, user_id INT NOT NULL, actions VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_F08FC65C5F0F2752 (documents_id), INDEX IDX_F08FC65CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rencontre (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rencontre_user (rencontre_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_683EBC486CFC0818 (rencontre_id), INDEX IDX_683EBC48A76ED395 (user_id), PRIMARY KEY(rencontre_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rencontre_document (rencontre_id INT NOT NULL, document_id INT NOT NULL, INDEX IDX_EE5C77B66CFC0818 (rencontre_id), INDEX IDX_EE5C77B6C33F7837 (document_id), PRIMARY KEY(rencontre_id, document_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserved (user_id INT NOT NULL, document_id INT NOT NULL, INDEX IDX_4DA2EBC2A76ED395 (user_id), INDEX IDX_4DA2EBC2C33F7837 (document_id), PRIMARY KEY(user_id, document_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recommandations (user_id INT NOT NULL, document_id INT NOT NULL, INDEX IDX_2E7C1FDBA76ED395 (user_id), INDEX IDX_2E7C1FDBC33F7837 (document_id), PRIMARY KEY(user_id, document_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auteur_rencontre ADD CONSTRAINT FK_5CEB872760BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE auteur_rencontre ADD CONSTRAINT FK_5CEB87276CFC0818 FOREIGN KEY (rencontre_id) REFERENCES rencontre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CC33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7660BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7661232A4F FOREIGN KEY (document_type_id) REFERENCES document_type (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D75F0F2752 FOREIGN KEY (documents_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE logs ADD CONSTRAINT FK_F08FC65C5F0F2752 FOREIGN KEY (documents_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE logs ADD CONSTRAINT FK_F08FC65CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rencontre_user ADD CONSTRAINT FK_683EBC486CFC0818 FOREIGN KEY (rencontre_id) REFERENCES rencontre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rencontre_user ADD CONSTRAINT FK_683EBC48A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rencontre_document ADD CONSTRAINT FK_EE5C77B66CFC0818 FOREIGN KEY (rencontre_id) REFERENCES rencontre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rencontre_document ADD CONSTRAINT FK_EE5C77B6C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reserved ADD CONSTRAINT FK_4DA2EBC2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reserved ADD CONSTRAINT FK_4DA2EBC2C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recommandations ADD CONSTRAINT FK_2E7C1FDBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recommandations ADD CONSTRAINT FK_2E7C1FDBC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur_rencontre DROP FOREIGN KEY FK_5CEB872760BB6FE6');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7660BB6FE6');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CC33F7837');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D75F0F2752');
        $this->addSql('ALTER TABLE logs DROP FOREIGN KEY FK_F08FC65C5F0F2752');
        $this->addSql('ALTER TABLE rencontre_document DROP FOREIGN KEY FK_EE5C77B6C33F7837');
        $this->addSql('ALTER TABLE reserved DROP FOREIGN KEY FK_4DA2EBC2C33F7837');
        $this->addSql('ALTER TABLE recommandations DROP FOREIGN KEY FK_2E7C1FDBC33F7837');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7661232A4F');
        $this->addSql('ALTER TABLE auteur_rencontre DROP FOREIGN KEY FK_5CEB87276CFC0818');
        $this->addSql('ALTER TABLE rencontre_user DROP FOREIGN KEY FK_683EBC486CFC0818');
        $this->addSql('ALTER TABLE rencontre_document DROP FOREIGN KEY FK_EE5C77B66CFC0818');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D7A76ED395');
        $this->addSql('ALTER TABLE logs DROP FOREIGN KEY FK_F08FC65CA76ED395');
        $this->addSql('ALTER TABLE rencontre_user DROP FOREIGN KEY FK_683EBC48A76ED395');
        $this->addSql('ALTER TABLE reserved DROP FOREIGN KEY FK_4DA2EBC2A76ED395');
        $this->addSql('ALTER TABLE recommandations DROP FOREIGN KEY FK_2E7C1FDBA76ED395');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE auteur_rencontre');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE document_type');
        $this->addSql('DROP TABLE emprunt');
        $this->addSql('DROP TABLE logs');
        $this->addSql('DROP TABLE rencontre');
        $this->addSql('DROP TABLE rencontre_user');
        $this->addSql('DROP TABLE rencontre_document');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE reserved');
        $this->addSql('DROP TABLE recommandations');
    }
}
