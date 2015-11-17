<?php namespace Framework\Model;

abstract class Model {

    static private $_pdo;
    protected $pdo;

    static public function setConn(\PDO $pdo)
    {
        self::$_pdo = $pdo;
    }

    public function __construct()
    {
        $this->pdo = self::$_pdo;
        $this->init();
    }

    public function __get($prop)
    {
        switch ($prop)
        {
            case 'mapper':
            case 'db':
                $relational_exist = file_exists(URL_ROOT."vendor/respect/data");
                if ($relational_exist)
                {
                    $class = "\\Respect\\Relational\\".ucfirst($prop);
                    return $this->$prop = new $class($this->pdo);
                }
        }
    }

    protected function init() {}
}