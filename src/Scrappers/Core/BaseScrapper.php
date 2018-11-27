<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 12:02
 */

namespace App\Scrappers\Core;


use Symfony\Component\DomCrawler\Crawler;

class BaseScrapper
{

    /** @var Crawler */
    private $body;

    public function setBody(String $html) {
        $this->body = new Crawler($html);
    }

    public function __get($name)
    {
        if (method_exists($this, $name.'Selector')) {
            return $this->{$name.'Selector'}($this->body);
        }

        return null;
    }

}