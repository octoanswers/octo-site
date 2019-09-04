<?php

class Model_Question_init_with_DB_state_BaseTest extends PHPUnit\Framework\TestCase
{
    public function test_EnFullParams_ReturnObject()
    {
        $question = Question_Model::init_with_DB_state([
            'q_id'              => 13,
            'q_title'           => 'This is question?',
            'q_is_redirect'     => 1,
            'q_image_base_name' => 'foo-2015',
            'a_text'            => 'Yes, it is!',
            'a_len'             => 11,
            'a_updated_at'      => '2015-11-29 09:28:34',
            'count_categories'  => 0,
        ]);

        $this->assertEquals(13, $question->id);
        $this->assertEquals('This is question?', $question->title);
        $this->assertEquals(true, $question->isRedirect);
        $this->assertEquals('Yes, it is!', $question->answer->text);
        $this->assertEquals('2015-11-29 09:28:34', $question->answer->updatedAt);
        $this->assertEquals(0, $question->categoriesCount);
    }

    public function test_RuFullParams_ReturnObject()
    {
        $question = Question_Model::init_with_DB_state([
            'q_id'             => 13,
            'q_title'          => 'Это вопрос?',
            'q_is_redirect'    => 1,
            'a_text'           => 'Да, это вопрос!',
            'a_len'            => 15,
            'a_updated_at'     => '2015-11-29 09:28:34',
            'count_categories' => 0,
        ]);

        $this->assertEquals(13, $question->id);
        $this->assertEquals('Это вопрос?', $question->title);
        $this->assertEquals(true, $question->isRedirect);
        $this->assertEquals('Да, это вопрос!', $question->answer->text);
        $this->assertEquals('2015-11-29 09:28:34', $question->answer->updatedAt);
        $this->assertEquals(0, $question->categoriesCount);
    }
}
