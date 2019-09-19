<?php

class Helper_Sort_Contributors__sort_by_contributions__Test extends PHPUnit\Framework\TestCase
{
    public function testRevisionExists()
    {
        $contributors = [
            ['user' => 7,  'contribution' => 6],
            ['user' => 13, 'contribution' => 75],
            ['user' => 2,  'contribution' => 19],
        ];

        $contributors = \Helper\Sort\Contributors::sort_by_contributions($contributors);

        $this->assertEquals(13, $contributors[0]['user']);
        $this->assertEquals(2, $contributors[1]['user']);
        $this->assertEquals(7, $contributors[2]['user']);
    }

    public function test__EmptyParam()
    {
        $contributors = \Helper\Sort\Contributors::sort_by_contributions([]);

        $this->assertEquals(0, count($contributors));
    }
}
