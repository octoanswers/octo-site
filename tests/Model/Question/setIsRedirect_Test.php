<?php

class Model_Question_RedirectTest extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $question = new Question_Model();
        $question->isRedirect = true;

        $this->assertEquals(true, $question->isRedirect);
    }
}
