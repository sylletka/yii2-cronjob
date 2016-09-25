<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cronjob_day_of_week`.
 * Has foreign keys to the tables:
 *
 * - `cronjob`
 */
class m160925_215659_create_cronjob_day_of_week_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cronjob_day_of_week', [
            'id' => $this->primaryKey(),
            'cronjob' => $this->integer()->notNull(),
            'value' => $this->string(2),
        ]);

        // creates index for column `cronjob`
        $this->createIndex(
            'idx-cronjob_day_of_week-cronjob',
            'cronjob_day_of_week',
            'cronjob'
        );

        // add foreign key for table `cronjob`
        $this->addForeignKey(
            'fk-cronjob_day_of_week-cronjob',
            'cronjob_day_of_week',
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
            'fk-cronjob_day_of_week-cronjob',
            'cronjob_day_of_week'
        );

        // drops index for column `cronjob`
        $this->dropIndex(
            'idx-cronjob_day_of_week-cronjob',
            'cronjob_day_of_week'
        );

        $this->dropTable('cronjob_day_of_week');
    }
}
