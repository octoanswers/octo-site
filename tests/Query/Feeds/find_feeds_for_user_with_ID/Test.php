<?php

class Query_Feeds__find_feeds_for_user_with_IDTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['activities', 'questions', 'er_users_follow_users', 'er_users_follow_categories', 'er_users_follow_questions'], 'users' => ['users']];

    public function test__First_page()
    {
        $res = (new \Query\Feeds('ru'))->find_feeds_for_user_with_ID(4);

        $this->assertEquals(4, $res['user_id']);
        $this->assertEquals('SELECT * FROM activities WHERE (u_id IN (1,5,7)) OR (c_id IN (3,9)) OR (q_id IN (4)) ORDER BY id DESC LIMIT 10', $res['sql']);

        $activities = $res['activities'];

        $this->assertEquals(6, count($activities));

        $this->assertEquals(12, $activities[0]['id']);
        $this->assertEquals('followed_H_got_achievement', $activities[0]['activity_type']);

        $this->assertEquals(8, $activities[1]['id']);
        $this->assertEquals('followed_Q_added_A', $activities[1]['activity_type']);
    }
}
