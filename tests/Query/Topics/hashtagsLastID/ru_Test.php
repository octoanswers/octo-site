<?php

class Topics_Query__topicsLastID_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['topics']];

    public function test_base()
    {
        $actualResponse = (new Topics_Query('ru'))->topicsLastID();
        $this->assertEquals(17, $actualResponse);
    }
}
