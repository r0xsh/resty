<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 12:02
 */

namespace App\Scrappers\Core;


use App\Scrappers\Core\Exceptions\ScrapperException;
use Symfony\Component\DomCrawler\Crawler;

abstract class BaseScrapper implements \JsonSerializable
{

    /** @var Crawler */
    private $body;

    public function setBody(String $html) {
        $this->body = new Crawler($html);
    }

    /**
     * Return the url, and use '%s' where the handle need to be placed
     * @return string
     */
    abstract function urlHandler(): string;

    public function generateUrl(string $handle): string {
        return sprintf($this->urlHandler(), $handle);
    }

    /**
     * @param $name
     * @return string|null
     * @throws ScrapperException
     */
    public function __get($name): ?string
    {
        if (method_exists($this, $name.'Selector')) {
            try {
                return trim(
                    $this->{$name . 'Selector'}($this->body)
                );
            } catch (\Exception $e) {
                throw new ScrapperException(
                    sprintf('An error occurred while parsing "%s" argument', $name),
                    0, $e
                );
            }
        }
        return null;
    }

}