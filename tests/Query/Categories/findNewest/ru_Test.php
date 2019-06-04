<?php

class Categories_Query__findNewest_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test_withoutParams()
    {
        $categories = (new Categories_Query('ru'))->findNewest();

        $this->assertEquals(10, count($categories));

        $this->assertEquals(17, $categories[0]->id);
        $this->assertEquals('Фотосинтез', $categories[0]->title);

        $this->assertEquals(8, $categories[9]->id);
        $this->assertEquals('Парфюмерия', $categories[9]->title);
    }

    public function test_firstPage()
    {
        $categories = (new Categories_Query('ru'))->findNewest(1);

        $this->assertEquals(10, count($categories));

        $this->assertEquals(17, $categories[0]->id);
        $this->assertEquals('Фотосинтез', $categories[0]->title);

        $this->assertEquals(8, $categories[9]->id);
        $this->assertEquals('Парфюмерия', $categories[9]->title);
    }

    public function test_secondPage()
    {
        $categories = (new Categories_Query('ru'))->findNewest(2);

        $this->assertEquals(10, count($categories));

        $this->assertEquals(10, $categories[0]->id);
        $this->assertEquals('Религия', $categories[0]->title);

        $this->assertEquals(1, $categories[9]->id);
        $this->assertEquals('Русская литература', $categories[9]->title);
    }

    public function test_FindFirst13Questions_Ok()
    {
        $categories = (new Categories_Query('ru'))->findNewest(1, 13);

        $this->assertEquals(13, count($categories));

        $this->assertEquals(17, $categories[0]->id);
        $this->assertEquals('Фотосинтез', $categories[0]->title);

        $this->assertEquals(5, $categories[12]->id);
        $this->assertEquals('Москва', $categories[12]->title);
    }
}
