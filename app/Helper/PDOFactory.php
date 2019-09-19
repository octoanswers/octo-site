<?php

namespace Helper;

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

    public static function get_connection_to_lang_DB(string $lang)
    {
        return self::get_connection($lang);
    }

    public static function get_connection_to_users_DB()
    {
        return self::get_connection('users');
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
    public static function get_connection(string $database)
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
