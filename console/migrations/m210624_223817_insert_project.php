<?php

use yii\db\Migration;

/**
 * Class m210624_223817_insert_project
 */
class m210624_223817_insert_project extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%cms_project}}', [
            'acronym' => 'FL',
            'short_name' => 'FreeLemur.COM',
            'name' => 'FreeLemur.COM',
        ]);

        $this->insert('{{%cms_project}}', [
            'acronym' => 'MYHOME',
            'short_name' => 'MY HOME',
            'name' => 'MY HOME',
            'cms_project_status_id' => 2
        ]);

        $this->insert('{{%cms_project_domain}}', [
            'cms_project_id' => 1,
            'cms_tree_id' => 1,
            'name' => 'freelemur.com'
        ]);

        $this->insert('{{%cms_project_domain}}', [
            'cms_project_id' => 1,
            'cms_tree_id' => 1,
            'name' => 'snu1743.freelemur.com'
        ]);

        $this->insert('{{%cms_project_domain}}', [
            'cms_project_id' => 1,
            'cms_tree_id' => 1,
            'name' => 'snu1743-prod.freelemur.com'
        ]);

        $this->insert('{{%cms_project_domain}}', [
            'cms_project_id' => 1,
            'cms_tree_id' => 1,
            'name' => 'snu1743-stage.freelemur.com'
        ]);

        $this->insert('{{%cms_project_domain}}', [
            'cms_project_id' => 2,
            'cms_tree_id' => 2,
            'name' => 'dev-my-home'
        ]);

        $this->insert('{{%cms_tree}}', [
            'cms_project_owner_id' => 1
        ]);

        $this->insert('{{%cms_tree}}', [
            'cms_project_owner_id' => 2
        ]);

        $this->insert('{{%cms_project_tree_bind}}', [
            'cms_project_id' => 1,
            'cms_tree_id' => 1,
            'cms_project_tree_bind_status_id' => 2
        ]);

        $this->insert('{{%cms_project_tree_bind}}', [
            'cms_project_id' => 2,
            'cms_tree_id' => 2,
            'cms_project_tree_bind_status_id' => 2
        ]);

        $this->insert('{{%cms_project_user_bind}}', [
            'cms_project_id' => 1,
            'user_id' => 9
        ]);

        $this->insert('{{%cms_project_user_bind}}', [
            'cms_project_id' => 2,
            'user_id' => 9
        ]);

        $this->insert('{{%cms_project_status}}', [
            'name' => 'disabled',
            'title' => 'Disabled'
        ]);

        $this->insert('{{%cms_project_status}}', [
            'name' => 'enable',
            'title' => 'Enable'
        ]);

        $this->insert('{{%cms_project_tree_bind_status}}', [
            'name' => 'disabled',
            'title' => 'Disabled'
        ]);

        $this->insert('{{%cms_project_tree_bind_status}}', [
            'name' => 'enable',
            'title' => 'Enable'
        ]);

        $this->insert('{{%cms_project_tree_bind_status}}', [
            'name' => 'blocked',
            'title' => 'Blocked'
        ]);

        $this->insert('{{%cms_page}}', [
            'path' => 'hello',
            'name' => 'Hello',
            'title' => 'Hello',
            'hash_id' => md5('hello' . '69226f22702d07021eba7a6eff836ff'),
            'parent_id' => 0,
            'owner_id' => 1,
            'cms_tree_id' => 1,
            'level' => 0,
            'path_length' => 5,
            'is_active' => 1,
        ]);

        $this->insert('{{%cms_page_content}}', [
            'cms_page_id' => 1,
            'body' => '<h1>Hello!</h1>'
        ]);

        $actionIds = [1,2,3,4];
        foreach ($actionIds as $actionId){
            $this->insert('{{%cms_access_rule}}', [
                'cms_access_object_id' => 1,
                'cms_access_object_type_id' => 1,
                'cms_object_action_id' => $actionId,
                'role_type_id' => 2,
                'role_id' => 1,
                'cms_project_id' => 1
            ]);
        }

        $actionIds = [2];
        foreach ($actionIds as $actionId){
            $this->insert('{{%cms_access_rule}}', [
                'cms_access_object_id' => 1,
                'cms_access_object_type_id' => 1,
                'cms_object_action_id' => $actionId,
                'role_type_id' => 2,
                'role_id' => 0,
                'cms_project_id' => 1
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
