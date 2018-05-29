<?php

class Query_Users__userWithUsername__abnormal__id__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testIDNotExists()
    {
        $user = (new User_Query())->userWithUsername('notexist667');
        $this->assertEquals(null, $user);
    }
}
