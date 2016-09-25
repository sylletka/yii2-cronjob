<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cronjob_month`.
 * Has foreign keys to the tables:
 *
 * - `cronjob`
 */
class m160925_215753_create_cronjob_month_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cronjob_month', [
            'id' => $this->primaryKey(),
            'cronjob' => $this->integer()->notNull(),
            'value' => $this->string(2),
        ]);

        // creates index for column `cronjob`
        $this->createIndex(
            'idx-cronjob_month-cronjob',
            'cronjob_month',
            'cronjob'
        );

        // add foreign key for table `cronjob`
        $this->addForeignKey(
            'fk-cronjob_month-cronjob',
            'cronjob_month',
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
            'fk-cronjob_month-cronjob',
            'cronjob_month'
        );

        // drops index for column `cronjob`
        $this->dropIndex(
            'idx-cronjob_month-cronjob',
            'cronjob_month'
        );

        $this->dropTable('cronjob_month');
    }
}
