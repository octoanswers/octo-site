<?php

class Query_Users__user_with_username__abnormal__IDTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test__ID_not_exists()
    {
        $user = (new \Query\User())->user_with_username('notexist667');
        $this->assertEquals(null, $user);
    }
}
