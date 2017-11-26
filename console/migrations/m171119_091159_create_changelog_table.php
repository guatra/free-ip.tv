<?php

use yii\db\Migration;

/**
 * Handles the creation of table `changelog`.
 */
class m171119_091159_create_changelog_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('changelog', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'body' => $this->text(),
            'visible' => $this->smallInteger()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('changelog');
    }
}
