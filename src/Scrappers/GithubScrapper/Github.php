<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 28/11/18
 * Time: 15:40
 */

namespace App\Scrappers\GithubScrapper;


use App\Scrappers\Core\ProfileScrapper;
use Symfony\Component\DomCrawler\Crawler;

class Github extends ProfileScrapper
{

    /**
     * Return the url, and use '%s' where the handle need to be placed
     * @return string
     */
    function urlHandler(): string
    {
        return 'https://github.com/%s';
    }

    /**
     * Return CSS selector of title
     * @param Crawler $crawler
     * @return String
     */
    function nameSelector(Crawler $crawler): ?String
    {
        return optional($crawler->filterXPath('//span[contains(@class, "p-name")]'))->text();
    }

    /**
     * Return CSS selector of date
     * @param Crawler $crawler
     * @return String
     */
    function descriptionSelector(Crawler $crawler): ?String
    {
        return optional($crawler->filterXPath('//meta[starts-with(@property, "og:description")]'))->attr('content');
    }

    /**
     * Return CSS selector of author
     * @param Crawler $crawler
     * @return String
     */
    function imageSelector(Crawler $crawler): ?String
    {
        return optional($crawler->filterXPath('//meta[starts-with(@property, "og:image")]'))->attr('content');
    }

    function usernameSelector(Crawler $crawler): ?String
    {
        return optional($crawler->filterXPath('//meta[starts-with(@property, "profile:username")]'))->attr('content');
    }
}