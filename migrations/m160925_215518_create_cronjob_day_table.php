<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cronjob_day`.
 * Has foreign keys to the tables:
 *
 * - `cronjob`
 */
class m160925_215518_create_cronjob_day_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cronjob_day', [
            'id' => $this->primaryKey(),
            'cronjob' => $this->integer()->notNull(),
            'value' => $this->string(2),
        ]);

        // creates index for column `cronjob`
        $this->createIndex(
            'idx-cronjob_day-cronjob',
            'cronjob_day',
            'cronjob'
        );

        // add foreign key for table `cronjob`
        $this->addForeignKey(
            'fk-cronjob_day-cronjob',
            'cronjob_day',
            'cronjob',
            'cronjob',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `cronjob`
        $this->dropForeignKey(
            'fk-cronjob_day-cronjob',
            'cronjob_day'
        );

        // drops index for column `cronjob`
        $this->dropIndex(
            'idx-cronjob_day-cronjob',
            'cronjob_day'
        );

        $this->dropTable('cronjob_day');
    }
}
