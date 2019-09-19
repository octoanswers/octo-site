<?php

use PHPUnit\Framework\TestCase;

abstract class Abstract_DB_TestCase extends TestCase
{
    protected $setUpDB = [];

    protected $requestStub;
    protected $response;
    protected $args;
    protected $arrayResponse;
    protected $complementaryActions;
    protected $cookieStorageStub;

    protected function setUp(): void
    {
        if (count($this->setUpDB)) {
            foreach ($this->setUpDB as $database => $databaseTables) {
                $pdo = Helper\PDOFactory::get_connection($database);
                foreach ($databaseTables as $table) {
                    require "tests/_DB/schema/$table.php";
                    require "tests/_DB/data/$database/$table.php";
                }
                $pdo = null;
            }
        }

        $this->requestStub = $this->getMockBuilder(\Slim\Http\Request::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->response = new \Slim\Http\Response();
        $this->args = [];
        $this->arrayResponse = true;
        $this->complementaryActions = false;

        $this->cookieStorageStub = $this->getMockBuilder('\Helper\CookieStorage')->getMock();
    }

    protected function tearDown(): void
    {
        if (count($this->setUpDB)) {
            foreach ($this->setUpDB as $database => $databaseTables) {
                $pdo = Helper\PDOFactory::get_connection($database);
                foreach ($databaseTables as $table) {
                    $pdo->exec("DROP TABLE IF EXISTS `$table`;");
                }
                $pdo = null;
            }
        }

        $this->requestStub = null;
        $this->response = null;

        $this->cookieStorageStub = null;
    }
}
