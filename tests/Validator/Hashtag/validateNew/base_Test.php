<?php

class Validator_Hashtag_validateNew_BaseTest extends PHPUnit\Framework\TestCase
{
    public function test_ValidateNewTopicWithFullParams_Ok()
    {
        $topic = new Hashtag_Model();
        $topic->setTitle('iPhone 8');

        $this->assertEquals(true, Topic_Validator::validateNew($topic));
    }
}
