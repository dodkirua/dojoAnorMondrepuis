<?php
namespace Model;

use PDO;
use PDOException;

class DB{

    private static  ?PDO $dbInstance = null;
    private static array $arrayError = [];

    /**
     * DbStatic constructor.
     */
    public function __construct(){
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/conf.local.php")){
            require_once $_SERVER['DOCUMENT_ROOT'] . "/conf.local.php";
        }
        else {
            require_once $_SERVER['DOCUMENT_ROOT'] . "/conf.php";
        }
        /**
         * @var String $host
         * @var String $db
         * @var String $port
         * @var String $user
         * @var String $pass
         */
        if (is_null($host) || is_null($db) || is_null($user)){
            self::$arrayError[] = "Il manque au moins une variable de connection.";
        }
        else {
            if (is_null($port)){
                $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
            }
            else{
                $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8";
            }

            try {
                self::$dbInstance = new PDO($dsn, $user, $pass);
                self::$dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$dbInstance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$dbInstance->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            } catch (PDOException $exception) {
                self::$arrayError[] = $exception->getMessage();
            }
        }
    }

    /**
     * Return PDO instance.
     */
    public static function getInstance(): ?PDO    {
        if (is_null(self::$dbInstance)) {
            new self();
        }
        return self::$dbInstance;
    }

    /**
     * Avoid instance to be cloned.
     */
    public function __clone() { }

    /**
     * Return array of error
     * @return array
     */
    public static function getError() : array{
        return self::$arrayError;
    }

}