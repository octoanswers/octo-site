<?php

class Contributors_Humanizer extends Abstract_Humanizer
{
    public function humanize(int $count): string
    {
        if ($count < 0) {
            throw new Exception('Count param '.$count.' must be greater than or equal to 0', 1);
        }

        if ($count === 0) {
            return $this->loc->t('wordform', 'no_contributors');
        }

        $wordforms = [
            $this->loc->t('wordform', '1_contributor'),
            $this->loc->t('wordform', '2_contributors'),
            $this->loc->t('wordform', '5_contributors'),
        ];
        $count_wordform = $this->humanizeCount($count, $wordforms);

        return $count.' '.$count_wordform;
    }
}
