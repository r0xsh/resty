<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 28/11/18
 * Time: 12:01
 */

use App\Support\Optional;
if (!function_exists('optional')) {
    /**
     * Allow arrow-syntax access of optional objects by using a higher-order
     * proxy object. The eliminates some need of ternary and null coalesce
     * operators in Blade templates.
     *
     * @param mixed|null $value
     *
     * @return Optional
     */
    function optional($value)
    {
        if ($value instanceof \Symfony\Component\DomCrawler\Crawler && $value->count() == 0) {
            $value = null;
        }
        return new Optional($value);
    }
}