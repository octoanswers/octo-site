<?php

/**
 * Handling database connection.
 */
class PDOFactory
{
    /**
     * Connection to DB.
     *
     * @var array
     */
    protected static $connection;

    public static function getConnectionToLangDB(string $lang)
    {
        return self::getConnection($lang);
    }

    public static function getConnectionToUsersDB()
    {
        return self::getConnection('users');
    }

    public static function getConnectionToInterDB()
    {
        throw new \Exception('Not implemented method getConnectionToInterDB', 1);
    }

    /**
     * Private common factory.
     *
     * @param string $database   Database postfix (DB area for queries).
     * @param string $dbUsername Username for access to MySQL.
     * @param string $dbPassword Password for access to MySQL.
     *
     * @return Database
     */
    public static function getConnection(string $database)
    {
        if (!isset(self::$connection[$database])) {
            $DB_DSN = 'mysql:host=localhost;dbname=ap_' . $database . ';charset=utf8';

            $pdo = new PDO($DB_DSN, DB_USERNAME, DB_PASSWORD);
            $pdo->exec('SET CHARACTER SET utf8');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$connection[$database] = $pdo;
        }

        return self::$connection[$database];
    }

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function __construct()
    {
        // Do nothing
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     */
    private function __clone()
    {
        // Do nothing
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     */
    private function __wakeup()
    {
        // Do nothing
    }
}
