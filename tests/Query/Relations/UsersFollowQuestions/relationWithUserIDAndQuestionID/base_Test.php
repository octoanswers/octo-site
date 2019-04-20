<?php

class UsersFollowQuestions_Relations_Query__relationWithUserIDAndQuestionID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_questions']];

    public function test__RelationExists()
    {
        $relation = (new UsersFollowQuestions_Relations_Query('ru'))->relationWithUserIDAndQuestionID(7, 23);

        $this->assertEquals(5, $relation->id);
        $this->assertEquals(7, $relation->userID);
        $this->assertEquals(23, $relation->questionID);
        $this->assertEquals('2015-12-16 13:28:56', $relation->createdAt);
    }

    public function test__RelationNotExists()
    {
        $relation = (new UsersFollowQuestions_Relations_Query('ru'))->relationWithUserIDAndQuestionID(3, 99);
        $this->assertEquals(null, $relation);
    }
}
