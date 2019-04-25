<?php

class HashtagValidator_validateExistsTest extends PHPUnit\Framework\TestCase
{
    public function test_Validate_exists_hashtag()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = 'apple';

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_Validate_exists_hashtag_on_Russian()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = 'яблоко';

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }


    public function test_Validate_hashtag_with_ID_equal_zero()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 0;
        $hashtag->title = 'iphone8';

        $this->expectExceptionMessage('Hashtag id param 0 must be greater than or equal to 1');
        Hashtag_Validator::validateExists($hashtag);
    }

    public function test_Validate_hashtag_with_ID_below_zero()
    {
        $hashtag = new Hashtag();
        $hashtag->id = -1;
        $hashtag->title = 'iphone8';

        $this->expectExceptionMessage('Hashtag id param -1 must be greater than or equal to 1');
        Hashtag_Validator::validateExists($hashtag);
    }

    public function test_Validate_hashtag_with_shortest_title()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = 'xy';

        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_Exception_when_hashtag_title_not_set()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;

        $this->expectExceptionMessage('Hashtag title param null must be a string');
        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_Validate_hashtag_where_title_is_empty()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = '';

        $this->expectExceptionMessage('Hashtag title param "" must have a length between 2 and 127');
        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }

    public function test_Validate_hashtag_with_longest_title()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 13;
        $hashtag->title = 'title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title';

        $this->expectExceptionMessage('Hashtag title param "title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title" must have a length between 2 and 127');
        $this->assertEquals(true, Hashtag_Validator::validateExists($hashtag));
    }
}
