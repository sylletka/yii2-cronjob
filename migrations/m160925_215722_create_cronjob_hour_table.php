<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cronjob_hour`.
 * Has foreign keys to the tables:
 *
 * - `cronjob`
 */
class m160925_215722_create_cronjob_hour_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cronjob_hour', [
            'id' => $this->primaryKey(),
            'cronjob' => $this->integer()->notNull(),
            'value' => $this->string(2),
        ]);

        // creates index for column `cronjob`
        $this->createIndex(
            'idx-cronjob_hour-cronjob',
            'cronjob_hour',
            'cronjob'
        );

        // add foreign key for table `cronjob`
        $this->addForeignKey(
            'fk-cronjob_hour-cronjob',
            'cronjob_hour',
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
            'fk-cronjob_hour-cronjob',
            'cronjob_hour'
        );

        // drops index for column `cronjob`
        $this->dropIndex(
            'idx-cronjob_hour-cronjob',
            'cronjob_hour'
        );

        $this->dropTable('cronjob_hour');
    }
}
