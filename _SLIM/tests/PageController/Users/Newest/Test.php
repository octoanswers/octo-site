<?php

namespace Tests\PageController\Users\Newest;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Get_EN_page_data()
    {
        $controller = new \PageController\Users\Newest('en');
        $view_data = $controller->get_data('newest', 0);

        $this->assertEquals('New users from around the world – Page 0 – Answeropedia', $view_data->page_title);
    }

    public function test__Get_RU_page_data()
    {
        $controller = new \PageController\Users\Newest('ru');
        $view_data = $controller->get_data('newest', 0);

        $this->assertEquals('Новые пользователи со всего мира – Страница 0 – Ансверопедия', $view_data->page_title);
    }
}
