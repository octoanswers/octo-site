<?php

namespace Renderer;

class Page
{
    public static function render(string $template, \DTO\ViewData\Basic $view_data): string
    {
        if (!$template) {
            throw new \Exception('Page template not set!', 1);
        }

        if ($view_data->lang == null) {
            throw new \Exception('Lang not set in VieData', 1);
        }

        $full_page = TEMPLATE_PATH . '/' . $template . '/_page.phtml';

        ob_start();
        if (file_exists($full_page)) {
            include $full_page;
        } else {
            include TEMPLATE_PATH . '/wrapper.phtml';
        }
        $output = ob_get_clean();

        return $output;
    }
}
