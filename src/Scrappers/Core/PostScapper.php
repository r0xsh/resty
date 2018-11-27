<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 09:52
 */

namespace App\Scrappers\Core;


use Symfony\Component\DomCrawler\Crawler;

abstract class PostScapper extends BaseScrapper
{


    /**
     * Give a name in lowercase
     * Used for internal routing
     * @return String
     */
    abstract function entityName(): String;

    /**
     * Return CSS selector of title
     * @param Crawler $crawler
     * @return String
     */
    abstract function titleSelector(Crawler $crawler): ?String;


    /**
     * Return CSS selector of date
     * @param Crawler $crawler
     * @return String
     */
    abstract function dateSelector(Crawler $crawler): ?String;


    /**
     * Return CSS selector of author
     * @param Crawler $crawler
     * @return String
     */
    abstract function authorSelector(Crawler $crawler): ?String;


    /**
     * Return CSS selector of content
     * @param Crawler $crawler
     * @return String
     */
    abstract function contentSelector(Crawler $crawler): ?String;


    /**
     * Return CSS selector of main image
     * @param Crawler $crawler
     * @return String
     */
    abstract function mainImageSelector(Crawler $crawler): ?String;

}