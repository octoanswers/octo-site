<?php

class Model_Question_initWithDBState_BaseTest extends PHPUnit\Framework\TestCase
{
    public function test_EnFullParams_ReturnObject()
    {
        $question = Question_Model::initWithDBState([
            'q_id' => 13,
            'q_title' => 'This is question?',
            'q_is_redirect' => 1,
            'a_text' => 'Yes, it is!',
            'a_hashtags' => '["ICQ","Web"]',
            'a_len' => 11,
            'q_image_base_name' => 'foo-2015',

            'a_updated_at' => '2015-11-29 09:28:34'
        ]);

        $this->assertEquals(13, $question->getID());
        $this->assertEquals('This is question?', $question->getTitle());
        $this->assertEquals(true, $question->isRedirect());
        $this->assertEquals('Yes, it is!', $question->answer->text);
        $this->assertEquals('["ICQ","Web"]', $question->getHashtagsJSON());
        $this->assertEquals(["ICQ","Web"], $question->getHashtags());
        $this->assertEquals('2015-11-29 09:28:34', $question->answer->updatedAt);
    }

    public function test_RuFullParams_ReturnObject()
    {
        $question = Question_Model::initWithDBState([
            'q_id' => 13,
            'q_title' => 'Это вопрос?',
            'q_is_redirect' => 1,
            'a_text' => 'Да, это вопрос!',
            'a_hashtags' => null,
            'a_len' => 15,
            'a_updated_at' => '2015-11-29 09:28:34'
        ]);

        $this->assertEquals(13, $question->getID());
        $this->assertEquals('Это вопрос?', $question->getTitle());
        $this->assertEquals(true, $question->isRedirect());
        $this->assertEquals('Да, это вопрос!', $question->answer->text);
        $this->assertEquals(null, $question->getHashtagsJSON());
        $this->assertEquals([], $question->getHashtags());
        $this->assertEquals('2015-11-29 09:28:34', $question->answer->updatedAt);
    }
}
