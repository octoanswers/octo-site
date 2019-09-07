<?php

class SlimApp__Test extends PHPUnit\Framework\TestCase
{
    public function test__Basic_size()
    {
        $app = new SlimApp();

        $this->assertInstanceOf(SlimApp::class, $app);
    }

    public function test__Get_app_method()
    {
        $app = (new SlimApp())->get_app();

        $this->assertInstanceOf(Slim\App::class, $app);
    }
}
