<?php

namespace Test\Query\Flow\find_flow;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['activities', 'questions', 'er_users_follow_users', 'er_users_follow_categories', 'er_users_follow_questions'], 'users' => ['users']];

    public function test__First_page()
    {
        $activities = (new \Query\Flow('ru'))->find_flow();

        $this->assertEquals(10, count($activities));

        $this->assertEquals(12, $activities[0]['id']);
        $this->assertEquals('followed_H_got_achievement', $activities[0]['activity_type']);
        $this->assertEquals('{"category":{"id": 3}, "achievement": {"type": "100_followers"}}', $activities[0]['data']);
        $this->assertEquals('2015-11-29 09:28:34', $activities[0]['created_at']);

        $this->assertEquals(3, $activities[9]['id']);
        $this->assertEquals('followed_U_follow_H', $activities[9]['activity_type']);
        $this->assertEquals('{"category":{"id": 3}, "question": {"id": 13}}', $activities[9]['data']);
        $this->assertEquals('2015-11-29 09:28:34', $activities[9]['created_at']);
    }
}
