<?php

namespace Test\Validator\Question\validate_image_base_name;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__Image_base_name_not_set()
    {
        $this->assertEquals(null, \Validator\Question::validate_image_base_name(null));
    }

    public function test__Image_base_name_is_empty()
    {
        $this->expectExceptionMessage('Question "imageBaseName" property "" must have a length between 4 and 64');
        \Validator\Question::validate_image_base_name('');
    }

    public function test__Image_base_name_too_short()
    {
        $this->expectExceptionMessage('Question "imageBaseName" property "foo" must have a length between 4 and 64');
        \Validator\Question::validate_image_base_name('foo');
    }

    public function test__Image_base_name_too_long()
    {
        $mageBaseName = 'abcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcd';

        $this->expectExceptionMessage('Question "imageBaseName" property "abcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcdabcd" must have a length between 4 and 64');
        \Validator\Question::validate_image_base_name($mageBaseName);
    }
}
