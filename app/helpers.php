<?php
if (!function_exists('pd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function pd()
    {
        echo '<pre>';
        array_map(function ($x) {
            print_r($x);
        }, func_get_args());
        echo '</pre>';
        die(1);
    }
}
if (!function_exists('pr')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function pr()
    {
        echo '<pre>';
        array_map(function ($x) {
            print_r($x);
        }, func_get_args());
        echo '</pre>';
    }
}
if (!function_exists('n')) {
    function n()
    {
        array_map(function ($int, $default_if_zero = '-') {
            return ($int == 0) ? $default_if_zero : $int;
        }, func_get_args());
    }
}