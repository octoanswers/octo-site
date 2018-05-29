<?php

class Validator_Question__validateImageBaseName__Test extends PHPUnit\Framework\TestCase
{
    public function test__NotSet()
    {
        $this->assertEquals(null, Question_Validator::validateImageBaseName(null));
    }

    public function test__Empty()
    {
        $this->expectExceptionMessage('Question "imageBaseName" property "" must have a length between 4 and 64');
        Question_Validator::validateImageBaseName('');
    }

    public function test__TooShort()
    {
        $this->expectExceptionMessage('Question "imageBaseName" property "foo" must have a length between 4 and 64');
        Question_Validator::validateImageBaseName('foo');
    }

    public function test__TooLong()
    {
        $mageBaseName = 'abcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcd';

        $this->expectExceptionMessage('Question "imageBaseName" property "abcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcd" must have a length between 4 and 64');
        Question_Validator::validateImageBaseName($mageBaseName);
    }
}
