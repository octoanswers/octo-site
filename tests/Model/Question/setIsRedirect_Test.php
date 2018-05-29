<?php

class Model_Question_setRedirectTest extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $question = new Question_Model();
        $question->setRedirect(true);

        $this->assertEquals(true, $question->isRedirect());
    }
}
