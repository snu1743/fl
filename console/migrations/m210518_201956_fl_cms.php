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
            'name' =>  $this->string(2048)->notNull()->unique(),
            'title' =>  $this->string(255),
            'hash_id' => $this->string(32)->notNull()->unique(),
            'parent_id' =>  $this->integer()->notNull(),
            'owner_id' =>  $this->integer()->notNull(),
            'cms_tree_id' =>  $this->integer()->notNull()->defaultValue(0),
//            'cms_page_type_id' =>  $this->integer()->notNull()->defaultValue(1),
            'level' => $this->integer(1024)->notNull(),
            'path_length' => $this->integer(2048)->notNull(),
            'is_active' => $this->tinyInteger()->defaultValue(0),
            'created_at' => $this->date()->defaultExpression('NOW()'),
            'updated_at' => $this->date(),
        ]);

        $this->createTable('{{%cms_object_action}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'title' => $this->string(250)->notNull()->unique()
        ]);

//        $this->createTable('{{%cms_page_type}}', [
//            'id' => $this->primaryKey(),
//            'name' => $this->string(50)->notNull()->unique(),
//            'title' => $this->string(250)->notNull()->unique()
//        ]);

        $this->insert('{{%cms_object_action}}', ['name' => 'create', 'title' => 'Create page']);
        $this->insert('{{%cms_object_action}}', ['name' => 'view', 'title' => 'View page']);
        $this->insert('{{%cms_object_action}}', ['name' => 'update', 'title' => 'Update page']);
        $this->insert('{{%cms_object_action}}', ['name' => 'delete', 'title' => 'Delete page']);

        $this->createTable('{{%cms_access_rule}}', [
            'cms_access_object_id' =>  $this->integer(),
            'cms_access_object_type_id' =>  $this->integer(),
            'cms_object_action_id' =>  $this->integer(),
            'role_type_id' =>  $this->tinyInteger(),
            'role_id' =>  $this->integer(),
            'cms_project_id' =>  $this->integer(),
        ]);

        $this->createTable('{{%cms_access_object_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'title' => $this->string(250)->notNull(),
        ]);

        $this->createIndex('idx-cms_access_rule', '{{%cms_access_rule}}', ['cms_access_object_id', 'cms_access_object_type_id', 'cms_object_action_id', 'role_type_id', 'role_id', 'cms_project_id'], true);

        $this->insert('{{%cms_access_object_type}}', [
            'name' => 'page',
            'title' => 'Page CMS'
        ]);

        $sql='INSERT INTO cms_access_rule (cms_access_object_id, cms_access_object_type_id, cms_object_action_id, role_type_id, role_id, cms_project_id) VALUES (0, 1, 1, 1, 0, 0)';
        yii::$app->db->createCommand($sql)->execute();

        $this->createTable('{{%cms_page_content}}', [
            'cms_page_id' =>  $this->integer()->unique(),
            'body' => $this->text()
        ]);

        $this->createTable('{{%cms_project}}', [
            'id' => $this->primaryKey(),
            'acronym' =>  $this->string(10)->notNull(),
            'short_name' =>  $this->string(50)->notNull()->unique(),
            'name' =>  $this->string(255)->notNull()->unique(),
            'cms_project_status_id' => $this->tinyInteger()->notNull()->defaultValue(2),
            'created_at' => $this->date()->defaultExpression('NOW()'),
            'update_at' => $this->date(),
        ]);

        $this->createTable('{{%cms_project_status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'title' => $this->string(250)->notNull(),
        ]);

        $this->createTable('{{%cms_project_domain}}', [
            'id' => $this->primaryKey(),
            'cms_project_id' => $this->integer()->notNull(),
            'cms_tree_id' => $this->integer()->notNull(),
            'name' =>  $this->string(255)->notNull()->unique(),
        ]);

        $this->createTable('{{%cms_tree}}', [
            'id' => $this->primaryKey(),
            'cms_project_owner_id' => $this->integer()->notNull(),
            'created_at' => $this->date()->defaultExpression('NOW()'),
        ]);

        $this->createTable('{{%cms_project_tree_bind}}', [
            'id' => $this->primaryKey(),
            'cms_project_id' => $this->integer()->notNull(),
            'cms_tree_id' => $this->integer()->notNull(),
            'cms_project_tree_bind_status_id' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created_at' => $this->date()->defaultExpression('NOW()'),
            'update_at' => $this->date(),
        ]);

        $this->createTable('{{%cms_project_user_bind}}', [
            'id' => $this->primaryKey(),
            'cms_project_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->date()->defaultExpression('NOW()')
        ]);

        $this->createTable('{{%cms_project_tree_bind_status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'title' => $this->string(250)->notNull(),
        ]);

        $this->createTable('{{%cms_group}}', [
            'id' => $this->primaryKey(),
            'cms_project_owner_id' => $this->integer()->notNull(),
            'name' => $this->string(50)->notNull(),
            'title' => $this->string(250)->notNull(),
            'description' => $this->string(10240),
            'created_at' => $this->date()->defaultExpression('NOW()'),
            'update_at' => $this->date()
        ]);

        $this->createTable('{{%cms_group_user_bind}}', [
            'id' => $this->primaryKey(),
            'cms_group_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->date()->defaultExpression('NOW()')
        ]);

        $this->createTable('{{%cms_project_group_bind}}', [
            'id' => $this->primaryKey(),
            'cms_project_id' => $this->integer()->notNull(),
            'cms_group_id' => $this->integer()->notNull(),
            'created_at' => $this->date()->defaultExpression('NOW()')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cms_page}}');
        $this->dropTable('{{%cms_object_action}}');
        $this->dropTable('{{%cms_access_rule}}');
        $this->dropTable('{{%cms_access_object_type}}');
        $this->dropTable('{{%cms_page_content}}');
        $this->dropTable('{{%cms_project}}');
        $this->dropTable('{{%cms_project_domain}}');
        $this->dropTable('{{%cms_tree}}');
        $this->dropTable('{{%cms_project_tree_bind}}');
        $this->dropTable('{{%cms_project_user_bind}}');
        $this->dropTable('{{%cms_project_status}}');
        $this->dropTable('{{%cms_project_tree_bind_status}}');
    }
}
