<?php

class AnsweropediaApp__Test extends PHPUnit\Framework\TestCase
{
    public function test__Basic_size()
    {
        $app = new AnsweropediaApp();

        $this->assertInstanceOf(AnsweropediaApp::class, $app);
    }

    public function test__Get_app_method()
    {
        $app = (new AnsweropediaApp())->get_app();

        $this->assertInstanceOf(Slim\App::class, $app);
    }
}
