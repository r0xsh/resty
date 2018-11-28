<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 14:33
 */

namespace App\Scrappers\WikipediaScrapper;


use App\Scrappers\Core\PostScrapper;
use Symfony\Component\DomCrawler\Crawler;

final class Wikipedia extends PostScrapper
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
        return optional($crawler->filterXPath('//*[@id="firstHeading"]'))->text();
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
        return null;
    }

    /**
     * Return CSS selector of main image
     * @param Crawler $crawler
     * @return String
     */
    function mainImageSelector(Crawler $crawler): ?String
    {
        return optional($crawler->filterXPath('//meta[@property="og:image"]'))->attr('content');
    }
}