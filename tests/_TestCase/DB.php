<?php

namespace Tests\DB;

abstract class DB extends \PHPUnit\Framework\TestCase
{
    protected $setUpDB = [];

    protected function setUp(): void
    {
        if (count($this->setUpDB)) {
            foreach ($this->setUpDB as $database => $databaseTables) {
                $pdo = \Helper\PDOFactory::get_connection($database);
                foreach ($databaseTables as $table) {
                    require "tests/_DB/schema/$table.php";
                    require "tests/_DB/data/$database/$table.php";
                }
                $pdo = null;
            }
        }
    }

    protected function tearDown(): void
    {
        if (count($this->setUpDB)) {
            foreach ($this->setUpDB as $database => $databaseTables) {
                $pdo = \Helper\PDOFactory::get_connection($database);
                foreach ($databaseTables as $table) {
                    $pdo->exec("DROP TABLE IF EXISTS `$table`;");
                }
                $pdo = null;
            }
        }
    }
}
