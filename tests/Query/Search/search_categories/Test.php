<?php

class Query_Search__search_categoriesTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test__Search_with_two_results()
    {
        $categories = (new \Query\Search('ru'))->search_categories('фото');

        $this->assertEquals(2, count($categories));

        $this->assertEquals(16, $categories[0]->id);
        $this->assertEquals('Фотография', $categories[0]->title);

        $this->assertEquals(17, $categories[1]->id);
        $this->assertEquals('Фотосинтез', $categories[1]->title);
    }

    public function test__One_letter_search()
    {
        $categories = (new \Query\Search('ru'))->search_categories('а');

        $this->assertEquals(10, count($categories));

        $this->assertEquals(1, $categories[0]->id);
        $this->assertEquals('Русская литература', $categories[0]->title);
    }
}
