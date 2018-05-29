<?php

class Query_Users__userWithEmail__abnormal__id__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testIDNotExists()
    {
        $user = (new User_Query())->userWithEmail('notexist@email.com');
        $this->assertEquals(null, $user);
    }
}
