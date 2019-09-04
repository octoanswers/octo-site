<?php

class Categories_Query__find_newest_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test_withoutParams()
    {
        $categories = (new Categories_Query('ru'))->find_newest();

        $this->assertEquals(10, count($categories));

        $this->assertEquals(17, $categories[0]->id);
        $this->assertEquals('Фотосинтез', $categories[0]->title);

        $this->assertEquals(8, $categories[9]->id);
        $this->assertEquals('Парфюмерия', $categories[9]->title);
    }

    public function test_firstPage()
    {
        $categories = (new Categories_Query('ru'))->find_newest(1);

        $this->assertEquals(10, count($categories));

        $this->assertEquals(17, $categories[0]->id);
        $this->assertEquals('Фотосинтез', $categories[0]->title);

        $this->assertEquals(8, $categories[9]->id);
        $this->assertEquals('Парфюмерия', $categories[9]->title);
    }

    public function test_secondPage()
    {
        $categories = (new Categories_Query('ru'))->find_newest(2);

        $this->assertEquals(10, count($categories));

        $this->assertEquals(10, $categories[0]->id);
        $this->assertEquals('Религия', $categories[0]->title);

        $this->assertEquals(1, $categories[9]->id);
        $this->assertEquals('Русская литература', $categories[9]->title);
    }

    public function test_Find_first_7_categories()
    {
        $categories = (new Categories_Query('ru'))->find_newest(1, 7);

        $this->assertEquals(7, count($categories));

        $this->assertEquals(17, $categories[0]->id);
        $this->assertEquals('Фотосинтез', $categories[0]->title);

        $this->assertEquals(11, $categories[6]->id);
        $this->assertEquals('Каша', $categories[6]->title);
    }
}
