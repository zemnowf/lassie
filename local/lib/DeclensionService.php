<?php

namespace Lib;

class DeclensionService
{
    public static function getDeclension($numberOfGoods, $declensions = ['товар', 'товара', 'товаров'])
    {
        $number = $numberOfGoods % 100;
        if ($number > 10 and $number < 20) {
            return $declensions[2];
        } else {
            $remainder = $number % 10;
            switch ($remainder) {
                case (1): return $declensions[0];
                case (2):
                case (3):
                case (4): return $declensions[1];
                default: return $declensions[2];
            }
        }
    }
}