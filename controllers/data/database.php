<?php
/**
 * User: chenlb
 */

namespace app\controllers\data;


class Database extends \yii\base\Action
{
    private static $_conn = [];
    public function run()
    {
        // Create Test DB Connection
        $db = $this->getDb('数据库名称');
        var_dump($db->getSchema()->getTableSchema('log')->columns['id']->isPrimaryKey);

        exit;
    }


    /**
     * 得到数据库连接
     */
    public function getDb($database)
    {
        if(!isset(self::$_conn[$database])){

            $connInfo = [
                'class'    => 'yii\db\Connection',
                'dsn'      => 'mysql:host=HOST_IP;port=3307;dbname='.$database,
                'username' => 'username',
                'password' => 'password',
                'charset'  => 'utf8'
            ];

            \Yii::$app->set($database, $connInfo);

            \Yii::$app->$database->open();

            self::$_conn[$database] = \Yii::$app->$database;
        }

        return self::$_conn[$database];
    }
}