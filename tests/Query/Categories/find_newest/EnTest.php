<?php

namespace Test\Query\Categories\find_newest;

class EnTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['en' => ['categories']];

    public function test__Find_without_params()
    {
        $categories = (new \Query\Categories('en'))->find_newest();

        $this->assertEquals(10, count($categories));

        $this->assertEquals(17, $categories[0]->id);
        $this->assertEquals('Photosynthez', $categories[0]->title);

        $this->assertEquals(8, $categories[9]->id);
        $this->assertEquals('Parfum', $categories[9]->title);
    }
}
