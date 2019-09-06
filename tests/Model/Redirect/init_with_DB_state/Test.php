<?php

class Model_Redirect__init_with_DB_state__Test extends PHPUnit\Framework\TestCase
{
    public function test_baseParams()
    {
        $redirect = Question_Redirect_Model::init_with_DB_state([
            'rd_from'  => 13,
            'rd_title' => 'This is question?',
        ]);

        $this->assertEquals(13, $redirect->fromID);
        $this->assertEquals('This is question?', $redirect->toTitle);
    }
}
