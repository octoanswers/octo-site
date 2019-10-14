<?php

namespace Test\Humanizer\DateTime\humanize_timestamp;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__zero_answer()
    {
        $this->assertEquals('19 мар 16 в 6:47', \Humanizer\DateTime::humanize_timestamp('ru', '2016-03-19 06:47:41'));
    }

    public function test__zero_answer2()
    {
        $this->assertEquals('19 Mar 16 at 6:47 am', \Humanizer\DateTime::humanize_timestamp('en', '2016-03-19 06:47:41'));
    }
}
