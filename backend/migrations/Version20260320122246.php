<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260320122246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY `FK_F52993989D86650F`');
        $this->addSql('DROP INDEX IDX_F52993989D86650F ON `order`');
        $this->addSql('ALTER TABLE `order` CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F5299398A76ED395 ON `order` (user_id)');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY `FK_52EA1F09DE18E50B`');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY `FK_52EA1F09FCDAEAAA`');
        $this->addSql('DROP INDEX IDX_52EA1F09DE18E50B ON order_item');
        $this->addSql('DROP INDEX IDX_52EA1F09FCDAEAAA ON order_item');
        $this->addSql('ALTER TABLE order_item ADD order_id INT NOT NULL, ADD product_id INT NOT NULL, DROP order_id_id, DROP product_id_id');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F098D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F094584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_52EA1F098D9F6D38 ON order_item (order_id)');
        $this->addSql('CREATE INDEX IDX_52EA1F094584665A ON order_item (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('DROP INDEX IDX_F5299398A76ED395 ON `order`');
        $this->addSql('ALTER TABLE `order` CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT `FK_F52993989D86650F` FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F52993989D86650F ON `order` (user_id_id)');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F098D9F6D38');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F094584665A');
        $this->addSql('DROP INDEX IDX_52EA1F098D9F6D38 ON order_item');
        $this->addSql('DROP INDEX IDX_52EA1F094584665A ON order_item');
        $this->addSql('ALTER TABLE order_item ADD order_id_id INT NOT NULL, ADD product_id_id INT NOT NULL, DROP order_id, DROP product_id');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT `FK_52EA1F09DE18E50B` FOREIGN KEY (product_id_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT `FK_52EA1F09FCDAEAAA` FOREIGN KEY (order_id_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_52EA1F09DE18E50B ON order_item (product_id_id)');
        $this->addSql('CREATE INDEX IDX_52EA1F09FCDAEAAA ON order_item (order_id_id)');
    }
}
