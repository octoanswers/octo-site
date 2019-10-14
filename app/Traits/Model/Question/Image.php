<?php

namespace Traits\Model\Question;

trait Image
{
    public function getImageURLLarge(string $lang): string
    {
        return SITE_URL . '/uploads/img/' . $lang . '/' . $this->id . '/' . $this->imageBaseName . '_lg.jpg';
    }

    public function getImageURLMedium(string $lang): string
    {
        return SITE_URL . '/uploads/img/' . $lang . '/' . $this->id . '/' . $this->imageBaseName . '_md.jpg';
    }
}
