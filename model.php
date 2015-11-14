<?php namespace Framework\Model;

use Respect\Relational;

abstract class Model {

    static private $_pdo = null;
    protected $pdo;

    static public function setConn(\PDO $pdo) {
        self::$_pdo = $pdo;
    }

    function __construct() {
        $this->pdo = self::$_pdo;
        $this->init();
    }

    protected function init() {}
}