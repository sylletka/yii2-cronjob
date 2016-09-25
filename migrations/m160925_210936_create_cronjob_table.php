<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cronjob`.
 */
class m160925_210936_create_cronjob_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable(
            'cronjob', 
            [
                'id' => $this->primaryKey(),
                'cron_command' => $this->text()->notNull(),
                'params' => $this->text()
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cronjob');
    }
}
