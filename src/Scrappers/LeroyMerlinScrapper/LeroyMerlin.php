<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 28/11/18
 * Time: 14:25
 */

namespace App\Scrappers\LeroyMerlinScrapper;


use App\Scrappers\Core\ProductScrapper;
use Symfony\Component\DomCrawler\Crawler;

class LeroyMerlin extends ProductScrapper
{

    /**
     * Return the url, and use '%s' where the handle need to be placed
     * @return string
     */
    function urlHandler(): string
    {
        return 'https://www.leroymerlin.fr/v3/p/produits/-%s';
    }

    /**
     * Return the product name
     * @param Crawler $crawler
     * @return string|null
     */
    public function nameSelector(Crawler $crawler): ?string
    {
        return optional(
            $crawler->filterXPath('//h1[contains(@class, "a-titleProduct")]')
        )->text();
    }

    /**
     * Return the product price in cent
     * @param Crawler $crawler
     * @return int|null
     */
    public function priceSelector(Crawler $crawler): ?int
    {
        return intval(floatval(
                optional($crawler->filterXPath('//span[contains(@class, "-a-priceAmount")]'))->text()) * 100
        );
    }

    /**
     * Return the product category
     * @param Crawler $crawler
     * @return string|null
     */
    public function categorySelector(Crawler $crawler): ?string
    {
        return null;
    }

    /**
     * Return the product availability
     * @param Crawler $crawler
     * @return string|null
     */
    public function availabilitySelector(Crawler $crawler): ?string
    {
        return optional(
            $crawler->filterXPath('//span[@class="a-deliveryAvailableStock"]')
        )->text();
    }

    /**
     * Return the product note between 0 and 1
     * @param Crawler $crawler
     * @return float|null
     */
    public function noteSelector(Crawler $crawler): ?float
    {
        return floatval(optional(
            $crawler->filterXPath('//p[@class="reviews-synthesis-score"]/strong')
        )->text()) / 5;
    }

    /**
     * Return the product image
     * @param Crawler $crawler
     * @return string|null
     */
    public function imageSelector(Crawler $crawler): ?string
    {
        return str_replace('//', 'https://', optional(
            $crawler->filterXPath('//figure[contains(@class, "a-elementSlider")]/img[1]')
        )->attr('src'));
    }
}