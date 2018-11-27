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

    /**
     * Give a name in lowercase
     * Used for internal routing
     * @return String
     */
    function entityName(): String
    {
        return 'coucou';
    }

    /**
     * Return CSS selector of title
     * @param Crawler $crawler
     * @return String
     */
    function titleSelector(Crawler $crawler): ?String
    {
        return $crawler->filterXPath('//*[@id="firstHeading"]')->html();
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
        return array_reduce($crawler->filter('#bodyContent > p')->getIterator(), function ($acc, $line){
            $acc .= $line.'\n';
            return $acc;
        }, '');
    }

    /**
     * Return CSS selector of main image
     * @param Crawler $crawler
     * @return String
     */
    function mainImageSelector(Crawler $crawler): ?String
    {
        return $crawler->filter('#bodyContent > img')->first()->attr('src');
    }
}