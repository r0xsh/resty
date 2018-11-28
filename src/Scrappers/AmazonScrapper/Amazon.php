<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 28/11/18
 * Time: 10:11
 */

namespace App\Scrappers\AmazonScrapper;


use App\Scrappers\Core\ProductScrapper;
use NumberFormatter;
use Symfony\Component\DomCrawler\Crawler;

class Amazon extends ProductScrapper
{

    /**
     * Return the url, and use '%s' where the handle need to be placed
     * @return string
     */
    function urlHandler(): string
    {
        return 'http://www.amazon.com/dp/%s';
    }

    /**
     * Return the product name
     * @param Crawler $crawler
     * @return string|null
     */
    public function nameSelector(Crawler $crawler): ?string
    {
        return optional($crawler->filterXPath('//*[@id="productTitle"]'))->text();
    }

    /**
     * Return the product price in cent
     * @param Crawler $crawler
     * @return int|null
     */
    public function priceSelector(Crawler $crawler): ?int
    {
        $currency = 'USD';
        $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        return intval($formatter->parseCurrency(
            optional($crawler->filterXPath('//span[contains(@id,"ourprice") or contains(@id,"saleprice")]'))->text(),
            $currency) * 100);
    }

    /**
     * Return the product category
     * @param Crawler $crawler
     * @return string|null
     */
    public function categorySelector(Crawler $crawler): ?string
    {
        return optional($crawler->filterXPath('//a[@class="a-link-normal a-color-tertiary"]'))->text();
    }

    /**
     * Return the product availability
     * @param Crawler $crawler
     * @return string|null
     */
    public function availabilitySelector(Crawler $crawler): ?string
    {
        return optional($crawler->filter('div#availability span'))->text();
    }


    /**
     * Return the product image
     * @param Crawler $crawler
     * @return string|null
     */
    public function imageSelector(Crawler $crawler): ?string
    {
        return optional($crawler->filterXPath('//img[@id="landingImage"]'))->attr('src');
    }

    /**
     * Return the product note between 0 and 1
     * @param Crawler $crawler
     * @return float|null
     */
    public function noteSelector(Crawler $crawler): ?float
    {
        $noteRaw = optional($crawler->filterXPath('//span[@class="a-icon-alt" and contains(text(), "out of")]'))->text();
        if (!is_null($noteRaw)) {
            preg_match('/([0-9.]+) out of/i', $noteRaw, $matches);
            if (count($matches) == 0)
                return null;
            return floatval($matches[0]) / 5;
        }
        return null;
    }

}