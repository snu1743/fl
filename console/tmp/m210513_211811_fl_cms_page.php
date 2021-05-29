<?php

use yii\db\Migration;

/**
 * Class m210513_211811_fl_cms_page
 */
class m210513_211811_fl_cms_page extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cms_page}}', [
            'id' => $this->primaryKey(),
            'path' =>  $this->string(2048)->notNull(),
            'hash' => $this->string(32)->notNull(),
            'parent_id' =>  $this->integer(),
            'owner_id' =>  $this->integer()->notNull(),
            'tree_id' =>  $this->integer()->notNull()->defaultValue(0),
            'level' => $this->integer(4096)->notNull(),
            'is_active' => $this->boolean()->defaultValue(false),
            'created_at' => $this->date()->defaultExpression('NOW()'),
            'updated_at' => $this->date(),
        ]);
//        $this->createIndex('idx-cms_page-path-cms_user_id-external_tree_id', '{{%cms_page}}', ['path', 'cms_user_id', 'external_tree_id'], true);
//        $this->createIndex('idx-cms_page-hash-cms_user_id-external_tree_id', '{{%cms_page}}', ['hash', 'cms_user_id', 'external_tree_id'], true);
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
            'role_type_id' =>  $this->integer(),
            'role_id' =>  $this->integer(),
        ]);
//        $this->createIndex('idx-cms_page_access', '{{%cms_page_access}}', ['cms_page_cms_page_id', 'cms_page_action_id', 'external_role_type_id', 'external_role_id'], true);
        $this->createTable('{{%cms_page_content}}', [
            'cms_page_id' =>  $this->integer(),
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
