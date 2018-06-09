<?php

class ColorMixer_Helper
{
     public static function colorBetween(string $color_from, string $color_to, $ratio)
     {
         $color_from = hexdec($color_from);
         $color_to = hexdec($color_to);

         // normalize ralio
         $ratio = $ratio<0?0:($ratio>1?1:$ratio);

         $rf = 0xFF & ($color_from >> 0x10);
         $gf = 0xFF & ($color_from >> 0x8);
         $bf = 0xFF & $color_from;
         $rt = 0xFF & ($color_to >> 0x10);
         $gt = 0xFF & ($color_to >> 0x8);
         $bt = 0xFF & $color_to;

         $between_color = str_pad( dechex(($bf + (($bt-$bf)*$ratio)) + ($gf + (($gt-$gf)*$ratio) << 0x8) + ($rf + (($rt-$rf)*$ratio) << 0x10)), 6,'0',STR_PAD_LEFT);

         return $between_color;
    }
}
