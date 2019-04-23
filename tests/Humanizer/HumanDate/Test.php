<?php

require_once 'app/Humanizer/HumanDate/HumanDate.php';

class HumanDate_Humanizer__Test extends PHPUnit\Framework\TestCase
{
    private $timezone;
    private $lang;
    private $humanDate;

    public function setUp(): void
    {
        $this->timezone = new DateTimeZone('UTC');
        $this->lang = 'en';

        $this->humanDate = new HumanDate($this->timezone, $this->lang);
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
        $dateObject = new DateTime($date, $this->timezone);
        $nowObject = new DateTime($now, $this->timezone);

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
        $date = new DateTime('-6 seconds');

        $formattedDate = $this->humanDate->format($date);
        $expectedDate = '6 seconds ago';

        $this->assertEquals($expectedDate, $formattedDate);
    }

    public function testWithoutTimezoneAndLanguage()
    {
        $date = new DateTime('-6 seconds');
        $humanDate = new HumanDate();

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
        return array(
            array('2015-01-15 00:00:00', '2015-01-15 00:00:01', 'just now'),
            array('2015-01-15 00:00:00', '2015-01-15 00:00:06', '6 seconds ago'),
            array('2015-01-15 00:00:00', '2015-01-15 00:00:45', 'one minute ago'),
            array('2015-01-15 00:00:00', '2015-01-15 00:01:45', 'two minutes ago'),
            array('2015-01-15 00:00:00', '2015-01-15 00:02:45', 'three minutes ago'),
            array('2015-01-15 00:00:00', '2015-01-15 00:03:45', 'four minutes ago'),
            array('2015-01-15 00:00:00', '2015-01-15 00:04:45', '5 minutes ago'),
            array('2015-01-15 00:00:00', '2015-01-15 00:05:29', '5 minutes ago'),
            array('2015-01-15 00:00:00', '2015-01-15 00:05:30', '6 minutes ago'),
            array('2015-01-15 00:00:00', '2015-01-15 00:45:45', 'one hour ago'),
            array('2015-01-15 00:00:00', '2015-01-15 01:45:45', 'two hours ago'),
            array('2015-01-15 00:00:00', '2015-01-15 02:45:45', 'three hours ago'),
            array('2015-01-15 00:00:00', '2015-01-15 03:45:45', 'four hours ago'),
            array('2015-01-15 00:00:00', '2015-01-15 04:45:46', 'today at 12:00 am'),
            array('2015-01-15 00:00:00', '2015-01-16 04:45:46', 'yesterday at 12:00 am'),
            array('2015-01-15 00:00:00', '2015-01-17 04:45:46', '15 Jun at 12:00 am'),
        );
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
        return array(
            array('2015-01-15 00:00:01', '2015-01-15 00:00:00', 'right now'),
            array('2015-01-15 00:00:06', '2015-01-15 00:00:00', 'in a 6 seconds'),
            array('2015-01-15 00:00:45', '2015-01-15 00:00:00', 'in a one minute'),
            array('2015-01-15 00:01:45', '2015-01-15 00:00:00', 'in a two minutes'),
            array('2015-01-15 00:02:45', '2015-01-15 00:00:00', 'in a three minutes'),
            array('2015-01-15 00:03:45', '2015-01-15 00:00:00', 'in a four minutes'),
            array('2015-01-15 00:04:45', '2015-01-15 00:00:00', 'in a 5 minutes'),
            array('2015-01-15 00:05:29', '2015-01-15 00:00:00', 'in a 5 minutes'),
            array('2015-01-15 00:05:30', '2015-01-15 00:00:00', 'in a 6 minutes'),
            array('2015-01-15 00:45:45', '2015-01-15 00:00:00', 'in a one hour'),
            array('2015-01-15 01:45:45', '2015-01-15 00:00:00', 'in a two hours'),
            array('2015-01-15 02:45:45', '2015-01-15 00:00:00', 'in a three hours'),
            array('2015-01-15 03:45:45', '2015-01-15 00:00:00', 'in a four hours'),
            array('2015-01-15 04:45:46', '2015-01-15 00:00:00', 'today at 4:45 am'),
            array('2015-01-16 04:45:46', '2015-01-15 00:00:00', 'tomorrow at 4:45 am'),
            array('2015-01-17 04:45:46', '2015-01-15 00:00:00', '17 Jun at 4:45 am'),
        );
    }
}
