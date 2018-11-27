<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 14:33
 */

namespace App\Scrappers\WikipediaScrapper;


use App\Scrappers\Core\PostScapper;
use Symfony\Component\DomCrawler\Crawler;

final class Wikipedia extends PostScapper
{

    function urlHandler(): string
    {
        return 'https://fr.wikipedia.com/wiki/%s';
    }

    /**
     * Return CSS selector of title
     * @param Crawler $crawler
     * @return String
     */
    function titleSelector(Crawler $crawler): ?String
    {
        return $crawler->filterXPath('//*[@id="firstHeading"]')->text();
    }

    /**
     * Return CSS selector of date
     * @param Crawler $crawler
     * @return String
     */
    function dateSelector(Crawler $crawler): ?String
    {
        return null;
    }

    /**
     * Return CSS selector of author
     * @param Crawler $crawler
     * @return String
     */
    function authorSelector(Crawler $crawler): ?String
    {
        return null;
    }

    /**
     * Return CSS selector of content
     * @param Crawler $crawler
     * @return String
     */
    function contentSelector(Crawler $crawler): ?String
    {
        return $crawler->filter('#bodyContent')->text();
    }

    /**
     * Return CSS selector of main image
     * @param Crawler $crawler
     * @return String
     */
    function mainImageSelector(Crawler $crawler): ?String
    {
        return $crawler->filter('.mw-parser-output img')->first()->attr('src');
    }

}