<?php

class Categories_Query__findNewest__en__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['en' => ['categories']];

    public function test_withoutParams()
    {
        $categories = (new Categories_Query('en'))->findNewest();

        $this->assertEquals(10, count($categories));

        $this->assertEquals(17, $categories[0]->id);
        $this->assertEquals('Photosynthez', $categories[0]->title);

        $this->assertEquals(8, $categories[9]->id);
        $this->assertEquals('Parfum', $categories[9]->title);
    }
}
