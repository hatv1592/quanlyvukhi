<?php
/**
 * Created by PhpStorm.
 * User: PhongCT
 * Date: 8/28/2016
 * Time: 12:22 PM
 */

namespace App\Lib;


class SEO
{
    static $title = 'Quan ly Vu Khi';
    static $description = 'He Thong Quan Ly Vu Khi';

    static function setHeader($title, $description = '')
    {
        self::$title = $title;
        self::$description = $description;
    }
}