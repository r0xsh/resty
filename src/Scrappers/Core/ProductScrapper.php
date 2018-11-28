<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 28/11/18
 * Time: 10:02
 */

namespace App\Scrappers\Core;


use Symfony\Component\DomCrawler\Crawler;

/**
 * @property string|null name
 * @property int|null price
 * @property string|null category
 * @property string|null availability
 * @property float|null note
 * @property string|null image
 */
abstract class ProductScrapper extends BaseScrapper
{

    /**
     * Return the product name
     * @param Crawler $crawler
     * @return string|null
     */
    abstract public function nameSelector(Crawler $crawler): ?string;

    /**
     * Return the product price in cent
     * @param Crawler $crawler
     * @return int|null
     */
    abstract public function priceSelector(Crawler $crawler): ?int;

    /**
     * Return the product category
     * @param Crawler $crawler
     * @return string|null
     */
    abstract public function categorySelector(Crawler $crawler): ?string;

    /**
     * Return the product availability
     * @param Crawler $crawler
     * @return string|null
     */
    abstract public function availabilitySelector(Crawler $crawler): ?string;

    /**
     * Return the product note between 0 and 1
     * @param Crawler $crawler
     * @return float|null
     */
    abstract public function noteSelector(Crawler $crawler): ?float;

    /**
     * Return the product image
     * @param Crawler $crawler
     * @return string|null
     */
    abstract public function imageSelector(Crawler $crawler): ?string;

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'image' => $this->image,
            'category' => $this->category,
            'availability' => $this->availability,
            'note' => $this->note
        ];
    }
}