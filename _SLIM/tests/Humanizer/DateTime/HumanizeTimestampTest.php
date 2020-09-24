<?php

namespace Test\Humanizer\DateTime;

use Humanizer\DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Class HumanizeTimestampTest
 *
 * @group humanizer
 */
class HumanizeTimestampTest extends TestCase
{
    public function test_Zero_answer()
    {
        $this->assertEquals('19 мар 16 в 6:47',
            DateTime::humanizeTimestamp('ru', '2016-03-19 06:47:41'));
    }

    public function test_Zero_answer2()
    {
        $this->assertEquals('19 Mar 16 at 6:47 am',
            DateTime::humanizeTimestamp('en', '2016-03-19 06:47:41'));
    }
}
