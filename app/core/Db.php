<?php

namespace Core;


use Core\Di\Di;

class Db extends \PDO
{
    private static $instance = null;

    public function __construct($dsn, $username, $password)
    {
        parent::__construct($dsn,$username,$password);
    }

    static public function getInstance()
    {

        $config = Di::getDefault()->get('config')->database;
        if (!self::$instance) {
            try{
            $instance = new Db(self::getDsn($config->driver,$config->host,$config->dbname),$config->username,$config->password);
            $instance->setAttribute(Db::ATTR_ERRMODE, Db::ERRMODE_EXCEPTION);
            $instance->setAttribute(Db::ATTR_EMULATE_PREPARES, false);
            self::$instance = $instance;
            } catch (\Exception $e){
                echo $e->getMessage();
            }
        }
        return self::$instance;
    }

    public static function getDsn($driver, $host, $dbname)
    {
        return $driver.':host='.$host.';dbname='.$dbname;
    }
}