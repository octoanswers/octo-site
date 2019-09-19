<?php

class HumanDate_Humanizer__Test extends PHPUnit\Framework\TestCase
{
    private $timezone;
    private $lang;
    private $humanDate;

    public function setUp(): void
    {
        $this->timezone = new \DateTimeZone('UTC');
        $this->lang = 'en';

        $this->humanDate = new \Humanizer\HumanDate\HumanDate($this->timezone, $this->lang);
    }

    /**
     * Test for DateTime, timestamps and strings.
     *
     * @param string $date
     * @param string $now
     * @param string $expectedDate
     */
    public function assertDateToFormat($date, $now, $expectedDate)
    {
        $dateObject = new \DateTime($date, $this->timezone);
        $nowObject = new \DateTime($now, $this->timezone);

        $dateTimestamp = $dateObject->getTimestamp();
        $nowTimestamp = $nowObject->getTimestamp();

        $formattedDateFromObjects = $this->humanDate->format($dateObject, $nowObject);
        $formattedDateFromTimestamps = $this->humanDate->format($dateTimestamp, $nowTimestamp);
        $formattedDateFromStrings = $this->humanDate->format($date, $now);

        $this->assertEquals($expectedDate, $formattedDateFromObjects);
        $this->assertEquals($expectedDate, $formattedDateFromTimestamps);
        $this->assertEquals($expectedDate, $formattedDateFromStrings);
    }

    public function testWithoutSetNow()
    {
        $date = new \DateTime('-6 seconds');

        $formattedDate = $this->humanDate->format($date);
        $expectedDate = '6 seconds ago';

        $this->assertEquals($expectedDate, $formattedDate);
    }

    public function testWithoutTimezoneAndLanguage()
    {
        $date = new \DateTime('-6 seconds');
        $humanDate = new \Humanizer\HumanDate\HumanDate();

        $formattedDate = $humanDate->format($date);
        $expectedDate = '6 seconds ago';

        $this->assertEquals($expectedDate, $formattedDate);
    }

    /**
     * Test date in past.
     *
     * @dataProvider dataPastTime
     *
     * @param string $now
     * @param string $date
     * @param string $expected
     */
    public function testPastTime($date, $now, $expected)
    {
        $this->assertDateToFormat($date, $now, $expected);
    }

    public function dataPastTime()
    {
        return [
            ['2015-01-15 00:00:00', '2015-01-15 00:00:01', 'just now'],
            ['2015-01-15 00:00:00', '2015-01-15 00:00:06', '6 seconds ago'],
            ['2015-01-15 00:00:00', '2015-01-15 00:00:45', 'one minute ago'],
            ['2015-01-15 00:00:00', '2015-01-15 00:01:45', 'two minutes ago'],
            ['2015-01-15 00:00:00', '2015-01-15 00:02:45', 'three minutes ago'],
            ['2015-01-15 00:00:00', '2015-01-15 00:03:45', 'four minutes ago'],
            ['2015-01-15 00:00:00', '2015-01-15 00:04:45', '5 minutes ago'],
            ['2015-01-15 00:00:00', '2015-01-15 00:05:29', '5 minutes ago'],
            ['2015-01-15 00:00:00', '2015-01-15 00:05:30', '6 minutes ago'],
            ['2015-01-15 00:00:00', '2015-01-15 00:45:45', 'one hour ago'],
            ['2015-01-15 00:00:00', '2015-01-15 01:45:45', 'two hours ago'],
            ['2015-01-15 00:00:00', '2015-01-15 02:45:45', 'three hours ago'],
            ['2015-01-15 00:00:00', '2015-01-15 03:45:45', 'four hours ago'],
            ['2015-01-15 00:00:00', '2015-01-15 04:45:46', 'today at 12:00 am'],
            ['2015-01-15 00:00:00', '2015-01-16 04:45:46', 'yesterday at 12:00 am'],
            ['2015-01-15 00:00:00', '2015-01-17 04:45:46', '15 Jun at 12:00 am'],
        ];
    }

    /**
     * Rest date in future.
     *
     * @dataProvider dataFutureTime
     *
     * @param string $date
     * @param string $now
     * @param string $expected
     */
    public function testFutureTime($date, $now, $expected)
    {
        $this->assertDateToFormat($date, $now, $expected);
    }

    public function dataFutureTime()
    {
        return [
            ['2015-01-15 00:00:01', '2015-01-15 00:00:00', 'right now'],
            ['2015-01-15 00:00:06', '2015-01-15 00:00:00', 'in a 6 seconds'],
            ['2015-01-15 00:00:45', '2015-01-15 00:00:00', 'in a one minute'],
            ['2015-01-15 00:01:45', '2015-01-15 00:00:00', 'in a two minutes'],
            ['2015-01-15 00:02:45', '2015-01-15 00:00:00', 'in a three minutes'],
            ['2015-01-15 00:03:45', '2015-01-15 00:00:00', 'in a four minutes'],
            ['2015-01-15 00:04:45', '2015-01-15 00:00:00', 'in a 5 minutes'],
            ['2015-01-15 00:05:29', '2015-01-15 00:00:00', 'in a 5 minutes'],
            ['2015-01-15 00:05:30', '2015-01-15 00:00:00', 'in a 6 minutes'],
            ['2015-01-15 00:45:45', '2015-01-15 00:00:00', 'in a one hour'],
            ['2015-01-15 01:45:45', '2015-01-15 00:00:00', 'in a two hours'],
            ['2015-01-15 02:45:45', '2015-01-15 00:00:00', 'in a three hours'],
            ['2015-01-15 03:45:45', '2015-01-15 00:00:00', 'in a four hours'],
            ['2015-01-15 04:45:46', '2015-01-15 00:00:00', 'today at 4:45 am'],
            ['2015-01-16 04:45:46', '2015-01-15 00:00:00', 'tomorrow at 4:45 am'],
            ['2015-01-17 04:45:46', '2015-01-15 00:00:00', '17 Jun at 4:45 am'],
        ];
    }
}
