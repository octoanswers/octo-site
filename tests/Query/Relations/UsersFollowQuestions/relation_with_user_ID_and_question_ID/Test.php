<?php

class Query_Relations_UsersFollowQuestions__relation_with_user_ID_and_question_IDTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_questions']];

    public function test__Relation_exists()
    {
        $relation = (new \Query\Relations\UsersFollowQuestions('ru'))->relation_with_user_ID_and_question_ID(7, 23);

        $this->assertEquals(5, $relation->id);
        $this->assertEquals(7, $relation->userID);
        $this->assertEquals(23, $relation->questionID);
        $this->assertEquals('2015-12-16 13:28:56', $relation->createdAt);
    }

    public function test__Relation_not_exists()
    {
        $relation = (new \Query\Relations\UsersFollowQuestions('ru'))->relation_with_user_ID_and_question_ID(3, 99);
        $this->assertEquals(null, $relation);
    }
}
