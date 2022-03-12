<?php

use yii\db\Migration;

/**
 * Class m220312_023242_init_rbac
 */
class m220312_023242_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        
        $createPengguna = $auth->createPermission('createPengguna');
        $createPengguna->description = 'CreatePengguna';
        $auth->add($createPengguna);

        $updatePengguna = $auth->createPermission('updatePengguna');
        $updatePengguna->description = 'UpdatePengguna';
        $auth->add($updatePengguna);

        $viewPengguna = $auth->createPermission('viewPengguna');
        $viewPengguna->description = 'viewPengguna';
        $auth->add($viewPengguna);

        $deletePengguna = $auth->createPermission('deletePengguna');
        $deletePengguna->description = 'deletePengguna';
        $auth->add($deletePengguna);
        
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $createPengguna);
        $auth->addChild($admin, $viewPengguna);
        $auth->addChild($admin, $updatePengguna);
        $auth->addChild($admin, $deletePengguna);

        $user = $auth->createRole('user');
        $auth->add($user);

        $auth->assign($admin, 1);
        $auth->assign($user, 2);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220312_023242_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
