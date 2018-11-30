<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 28/11/18
 * Time: 12:01
 */

use App\Support\Optional;
if (!function_exists('optional')) {
    function optional($value)
    {
        if ($value instanceof \Symfony\Component\DomCrawler\Crawler && $value->count() == 0) {
            $value = null;
        }
        return new Optional($value);
    }
}
if (!function_exists('dd')) {
    function dd($value)
    {
            return die(sprintf('<html><head><title>DEBUG !</title></head><body><pre>%s</pre></body></html>', print_r($value, true)));
    }
}