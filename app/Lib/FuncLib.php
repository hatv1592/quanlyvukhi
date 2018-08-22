<?php

namespace App\Lib;

class FuncLib
{
    public static function priceFormat($price, $return_if_zero = false)
    {
        if ($price) {
            return number_format((int)$price, 0, ',', '.');
        }
        if ($return_if_zero !== false) {
            return $return_if_zero;
        }
        return $price;
    }

    public static function numberFormat($number, $return_if_zero = '-')
    {
        return self::priceFormat($number, $return_if_zero);
    }

    public static function formatScore($score)
    {
        return number_format($score, 1, '.', '.');
    }


    public static function toArrayKeyValue($aryData, $key_field = null)
    {
        $aryReturn = array();
        if (empty($aryData)) {
            return [];
        }
        foreach ($aryData as $k => $v) {
            $v = (array)$v;
            $aryReturn[((!$key_field) ? $k : $v[$key_field])] = $v;
        }
        return $aryReturn;
    }

    public static function toArrayKeyValueGroup($aryData, $key_field)
    {
        $aryReturn = array();
        foreach ($aryData as $v) {
            $v = (array)$v;
            $aryReturn[$v[$key_field]][] = $v;
        }
        return $aryReturn;
    }

    public static function ucfirst($string, $e = 'utf-8')
    {
        if (function_exists('mb_strtoupper') && function_exists('mb_substr') && !empty($string)) {
            $string = mb_strtolower($string, $e);
            $upper = mb_strtoupper($string, $e);
            preg_match('#(.)#us', $upper, $matches);
            $string = $matches[1] . mb_substr($string, 1, mb_strlen($string, $e), $e);
        } else {
            $string = ucfirst($string);
        }
        return $string;
    }


    public static function read_num_forvietnamese($num)
    {
        return ucfirst(self::docso($num)) . ' đồng';
    }

    private static function docso($so)
    {
        $mangso = array('không', 'một', 'hai', 'ba', 'bốn', 'năm', 'sáu', 'bảy', 'tám', 'chín');

        if ($so == 0) return $mangso[0];
        $chuoi = "";
        $hauto = "";
        do {
            $ty = $so % 1000000000;
            $so = floor($so / 1000000000);
            if ($so > 0) {
                $chuoi = dochangtrieu($ty, true) . $hauto . $chuoi;
            } else {
                $chuoi = dochangtrieu($ty, false) . $hauto . $chuoi;
            }
            $hauto = " tỷ";
        } while ($so > 0);
        return trim($chuoi);
    }

    public static function stringToArray($str)
    {
        return explode(' ', preg_replace('/ +/', ' ', str_replace(',', ' ', trim($str))));
    }

    public static function addSpace($level, $space = '-')
    {
        $str = '';
        for ($i = 1; $i <= $level; $i++) {
            $str .= $space;
        }
        return $str;
    }


}


function dochangchuc($so, $daydu)
{
    $mangso = array('không', 'một', 'hai', 'ba', 'bốn', 'năm', 'sáu', 'bảy', 'tám', 'chín');

    $chuoi = "";
    $chuc = floor($so / 10);
    $donvi = $so % 10;
    if ($chuc > 1) {
        $chuoi = " " . $mangso[$chuc] . " mươi";
        if ($donvi == 1) {
            $chuoi .= " mốt";
        }
    } else if ($chuc == 1) {
        $chuoi = " mười";
        if ($donvi == 1) {
            $chuoi .= " một";
        }
    } else if ($daydu && $donvi > 0) {
        $chuoi = " lẻ";
    }
    if ($donvi == 5 && $chuc > 1) {
        $chuoi .= " lăm";
    } else if ($donvi > 1 || ($donvi == 1 && $chuc == 0)) {
        $chuoi .= " " . $mangso[$donvi];
    }
    return $chuoi;
}

function docblock($so, $daydu)
{
    $mangso = array('không', 'một', 'hai', 'ba', 'bốn', 'năm', 'sáu', 'bảy', 'tám', 'chín');

    $chuoi = "";
    $tram = floor($so / 100);
    $so = $so % 100;
    if ($daydu || $tram > 0) {
        $chuoi = " " . $mangso[$tram] . " trăm";
        $chuoi .= dochangchuc($so, true);
    } else {
        $chuoi = dochangchuc($so, false);
    }
    return $chuoi;
}

function dochangtrieu($so, $daydu)
{
    $chuoi = "";
    $trieu = floor($so / 1000000);
    $so = $so % 1000000;
    if ($trieu > 0) {
        $chuoi = docblock($trieu, $daydu) . " triệu";
        $daydu = true;
    }
    $nghin = floor($so / 1000);
    $so = $so % 1000;
    if ($nghin > 0) {
        $chuoi .= docblock($nghin, $daydu) . " nghìn";
        $daydu = true;
    }
    if ($so > 0) {
        $chuoi .= docblock($so, $daydu);
    }
    return $chuoi;
}

