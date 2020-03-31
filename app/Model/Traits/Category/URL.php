<?php

namespace Model\Traits\Category;

trait URL
{
    public function getURL(string $lang): string
    {
        $uri = $this->title;

        $uri = str_replace('_', '__', $uri);
        $uri = str_replace(' ', '_', $uri);

        return SITE_URL . '/' . $lang . '/category/' . urlencode($uri);
    }
}
