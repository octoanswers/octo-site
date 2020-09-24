<?php

namespace Tests\PageController\Question\Ask;

class Test extends \Test\TestCase\DB
{
    public function test__Get_EN_page_data()
    {
        $controller = new \PageController\Question\Ask('en');
        $view_data = $controller->get_data();

        $this->assertEquals('Ask Question – Answeropedia', $view_data->page_title);
    }

    public function test__Get_RU_page_data()
    {
        $controller = new \PageController\Question\Ask('ru');
        $view_data = $controller->get_data();

        $this->assertEquals('Задать вопрос – Ансверопедия', $view_data->page_title);
    }
}
