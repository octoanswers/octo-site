<?php

namespace Test\Validator\Relation\UserFollowQuestion\validate_exists;

class IDTest extends \PHPUnit\Framework\TestCase
{
    public function test__ID_equal_zero()
    {
        $rel = new \Model\Relation\UserFollowQuestion();
        $rel->id = 0;
        $rel->userID = 3;
        $rel->questionID = 9;

        $this->expectExceptionMessage('UserFollowQuestion relation "id" property 0 must be greater than or equal to 1');
        \Validator\Relation\UserFollowQuestion::validate_exists($rel);
    }

    public function test__ID_below_zero()
    {
        $rel = new \Model\Relation\UserFollowQuestion();
        $rel->id = -1;
        $rel->userID = 3;
        $rel->questionID = 9;

        $this->expectExceptionMessage('UserFollowQuestion relation "id" property -1 must be greater than or equal to 1');
        \Validator\Relation\UserFollowQuestion::validate_exists($rel);
    }
}
