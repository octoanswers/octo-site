<?php

namespace Test\Query\User\user_with_ID;

class IDTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['users' => ['users']];

    public function test__ID_not_exists()
    {
        $this->expectExceptionMessage('User not found');
        (new \Query\User())->user_with_ID(667);
    }

    public function test__ID_equal_zero()
    {
        $this->expectExceptionMessage('User id param 0 must be greater than or equal to 1');
        (new \Query\User())->user_with_ID(0);
    }

    public function test__ID_below_zero()
    {
        $this->expectExceptionMessage('User id param -1 must be greater than or equal to 1');
        (new \Query\User())->user_with_ID(-1);
    }
}
