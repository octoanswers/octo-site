<?php

class Query_Users__user_with_email__abnormal__id__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testIDNotExists()
    {
        $user = (new User_Query())->user_with_email('notexist@email.com');
        $this->assertEquals(null, $user);
    }
}
