<?php

class UserFollowQuestion_Relation_Validator__validate_existsTest extends PHPUnit\Framework\TestCase
{
    public function test__Full_params()
    {
        $rel = new \Model\Relation\UserFollowQuestion();
        $rel->id = 13;
        $rel->userID = 3;
        $rel->questionID = 9;
        $rel->createdAt = '2015-11-29 09:28:34';

        $this->assertEquals(true, \Validator\Relation\UserFollowQuestion::validate_exists($rel));
    }

    public function test__Min_params()
    {
        $rel = new \Model\Relation\UserFollowQuestion();
        $rel->id = 13;
        $rel->userID = 3;
        $rel->questionID = 9;

        $this->assertEquals(true, \Validator\Relation\UserFollowQuestion::validate_exists($rel));
    }
}
