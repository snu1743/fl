<?php

use yii\db\Migration;

/**
 * Class m210518_201956_fl_cms
 */
class m210518_201956_fl_cms extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cms_page}}', [
            'id' => $this->primaryKey(),
            'path' =>  $this->string(2048)->notNull()->unique(),
            'hash_id' => $this->string(32)->notNull()->unique(),
            'parent_id' =>  $this->integer()->notNull(),
            'owner_id' =>  $this->integer()->notNull(),
            'tree_id' =>  $this->integer()->notNull()->defaultValue(0),
            'level' => $this->integer(1024)->notNull(),
            'path_length' => $this->integer(2048)->notNull(),
            'is_active' => $this->boolean()->defaultValue(false),
            'created_at' => $this->date()->defaultExpression('NOW()'),
            'updated_at' => $this->date(),
        ]);
        $this->createIndex('idx-cms_page-alias-parent_id', '{{%cms_page}}', ['alias', 'parent_id'], true);

        $this->createTable('{{%cms_page_action}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique()
        ]);
        $this->insert('{{%cms_page_action}}', ['name' => 'create']);
        $this->insert('{{%cms_page_action}}', ['name' => 'view']);
        $this->insert('{{%cms_page_action}}', ['name' => 'update']);
        $this->insert('{{%cms_page_action}}', ['name' => 'delete']);

        $this->createTable('{{%cms_page_access}}', [
            'cms_page_id' =>  $this->integer(),
            'cms_page_action_id' =>  $this->integer(),
            'role_type_id' =>  $this->tinyInteger(),
            'role_id' =>  $this->integer(),
        ]);
        $this->createIndex('idx-cms_page_access', '{{%cms_page_access}}', ['cms_page_id', 'cms_page_action_id', 'role_type_id', 'role_id'], true);

        $sql='INSERT INTO cms_page_access (cms_page_id, cms_page_action_id, role_type_id, role_id) VALUES (0,1,1,0)';
        yii::$app->db->createCommand($sql)->execute();

        $this->createTable('{{%cms_page_content}}', [
            'cms_page_id' =>  $this->integer()->unique(),
            'body' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cms_page}}');
        $this->dropTable('{{%cms_page_action}}');
        $this->dropTable('{{%cms_page_access}}');
        $this->dropTable('{{%cms_page_content}}');
    }
}
