<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 09:52
 */

namespace App\Scrappers\Core;


use Symfony\Component\DomCrawler\Crawler;

/**
 * @property string|null title
 * @property string|null date
 * @property string|null author
 * @property string|null content
 * @property string|null mainImage
 */
abstract class PostScrapper extends BaseScrapper
{
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
            'title' => $this->title,
            'date' => $this->date,
            'image' => $this->mainImage,
            'author' => $this->author,
            'content' => $this->content
        ];
    }

}