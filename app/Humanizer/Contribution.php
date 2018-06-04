<?php

/**
 * I need to show a page views value in the format of 1K of equal to one thousand, or 1.1K, 1.2K, 1.9K etc,
 */
class Contribution_Humanizer
{
    public function humanizeCount(int $n): string
    {
        if ($count < 0) {
            throw new Exception('Count param '.$count.' must be greater than or equal to 0', 1);
        }

        if ($count === 0) {
            return $this->loc->t('wordform', 'no_contributors');
        }

        $formatted = '';

        if($n >= 1000 && $n < 1000000)
        {
            if($n%1000 === 0)
            {
                $formatted = ($n/1000);
            }
            else
            {
                $formatted = substr($n, 0, -3).'.'.substr($n, -3, -2);

                if(substr($formatted, -1, 1) === '0')
                {
                    $formatted = substr($formatted, 0, -2);
                }
            }

            $formatted.= 'k';
        }

        // $wordforms = [
        //     $this->loc->t('wordform', '1_contributor'),
        //     $this->loc->t('wordform', '2_contributors'),
        //     $this->loc->t('wordform', '5_contributors'),
        // ];
        // $count_wordform = $this->humanizeCount($count, $wordforms);

        return $formatted;
    }
}
