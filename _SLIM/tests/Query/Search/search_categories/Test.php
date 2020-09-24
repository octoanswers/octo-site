<?php

namespace Test\Query\Search\searchCategories;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test__Search_with_two_results()
    {
        $categories = (new \Query\Search('ru'))->searchCategories('фото');

        $this->assertEquals(2, count($categories));

        $this->assertEquals(16, $categories[0]->id);
        $this->assertEquals('Фотография', $categories[0]->title);

        $this->assertEquals(17, $categories[1]->id);
        $this->assertEquals('Фотосинтез', $categories[1]->title);
    }

    public function test__One_letter_search()
    {
        $categories = (new \Query\Search('ru'))->searchCategories('а');

        $this->assertEquals(10, count($categories));

        $this->assertEquals(1, $categories[0]->id);
        $this->assertEquals('Русская литература', $categories[0]->title);
    }
}
