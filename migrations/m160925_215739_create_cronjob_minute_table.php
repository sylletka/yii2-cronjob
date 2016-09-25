<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cronjob_minute`.
 * Has foreign keys to the tables:
 *
 * - `cronjob`
 */
class m160925_215739_create_cronjob_minute_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cronjob_minute', [
            'id' => $this->primaryKey(),
            'cronjob' => $this->integer()->notNull(),
            'value' => $this->string(2),
        ]);

        // creates index for column `cronjob`
        $this->createIndex(
            'idx-cronjob_minute-cronjob',
            'cronjob_minute',
            'cronjob'
        );

        // add foreign key for table `cronjob`
        $this->addForeignKey(
            'fk-cronjob_minute-cronjob',
            'cronjob_minute',
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
            'fk-cronjob_minute-cronjob',
            'cronjob_minute'
        );

        // drops index for column `cronjob`
        $this->dropIndex(
            'idx-cronjob_minute-cronjob',
            'cronjob_minute'
        );

        $this->dropTable('cronjob_minute');
    }
}
