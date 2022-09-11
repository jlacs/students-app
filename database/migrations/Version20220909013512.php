<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20220909013512 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE theories DROP FOREIGN KEY FK_E18C1B28EBA327D6');
        $this->addSql('CREATE TABLE students (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE students_subjects (student_id INT NOT NULL, subject_id INT NOT NULL, INDEX IDX_B7EAFEA9CB944F1A (student_id), INDEX IDX_B7EAFEA923EDC87 (subject_id), PRIMARY KEY(student_id, subject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subjects (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE students_subjects ADD CONSTRAINT FK_B7EAFEA9CB944F1A FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE students_subjects ADD CONSTRAINT FK_B7EAFEA923EDC87 FOREIGN KEY (subject_id) REFERENCES subjects (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE scientist');
        $this->addSql('DROP TABLE theories');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE students_subjects DROP FOREIGN KEY FK_B7EAFEA9CB944F1A');
        $this->addSql('ALTER TABLE students_subjects DROP FOREIGN KEY FK_B7EAFEA923EDC87');
        $this->addSql('CREATE TABLE scientist (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lastname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE theories (id INT AUTO_INCREMENT NOT NULL, scientist_id INT DEFAULT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_E18C1B28EBA327D6 (scientist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE theories ADD CONSTRAINT FK_E18C1B28EBA327D6 FOREIGN KEY (scientist_id) REFERENCES scientist (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE students');
        $this->addSql('DROP TABLE students_subjects');
        $this->addSql('DROP TABLE subjects');
    }
}
