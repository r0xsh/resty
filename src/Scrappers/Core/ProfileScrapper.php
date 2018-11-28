<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 09:52
 */

namespace App\Scrappers\Core;


use Symfony\Component\DomCrawler\Crawler;


abstract class ProfileScrapper extends BaseScrapper
{
    /**
     * Return CSS selector of title
     * @param Crawler $crawler
     * @return String
     */
    abstract function nameSelector(Crawler $crawler): ?String;


    abstract function usernameSelector(Crawler $crawler): ?String;


    /**
     * Return CSS selector of date
     * @param Crawler $crawler
     * @return String
     */
    abstract function descriptionSelector(Crawler $crawler): ?String;


    /**
     * Return CSS selector of author
     * @param Crawler $crawler
     * @return String
     */
    abstract function imageSelector(Crawler $crawler): ?String;


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
            'username' => $this->username,
            'description' => $this->description,
            'image' => $this->image
        ];
    }

}