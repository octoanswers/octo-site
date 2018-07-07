<?php

class Abstract_Humanizer
{
    protected $loc = null;

    #
    # Init methods
    #

    public function __construct()
    {

    }

    public function __destruct()
    {
    }

    /**
     * Get correct phrase for count.
     *
     * @param int   $number      Число от которого зависит окончание нужного нам слова
     * @param array $endingArray Массив форм слова с разными окончаниями
     */
    public function humanizeCount($number, $endingArray): string
    {
        $number = $number % 100;
        if ($number >= 11 && $number <= 19) {
            $ending = $endingArray[2];
        } else {
            $i = $number % 10;
            switch ($i) {
                case 1: $ending = $endingArray[0]; break;
                case 2:
                case 3:
                case 4: $ending = $endingArray[1]; break;
                default: $ending = $endingArray[2];
            }
        }

        return $ending;
    }
}
