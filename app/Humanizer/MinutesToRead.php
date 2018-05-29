<?php

class MinutesToRead_Humanizer extends Abstract_Humanizer
{
    public function humanizeCharactersCount(int $charactersCount): string
    {
        if ($charactersCount < 0) {
            throw new Exception('Count param '.$charactersCount.' must be greater than or equal to 0', 0);
        }
        $minutesToRead = ceil($charactersCount/1000);

        return $this->humanizeMinutesToRead($minutesToRead);
    }

    public function humanizeMinutesToRead(int $minutesToRead): string
    {
        if ($minutesToRead < 0) {
            throw new Exception('Count param '.$minutesToRead.' must be greater than or equal to 0', 0);
        }

        $wordforms = [
            $this->loc->t('wordform_1_minute_to_read'),
            $this->loc->t('wordform_2_minutes_to_read'),
            $this->loc->t('wordform_5_minutes_to_read'),
        ];
        $count_wordform = $this->humanizeCount($minutesToRead, $wordforms);

        return $minutesToRead.' '.$count_wordform;
    }
}
