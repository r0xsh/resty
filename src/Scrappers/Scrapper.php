<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 14:56
 */

namespace App\Scrappers;


use GuzzleHttp\Client;

class Scrapper
{

    private $scrappers;

    /**
     * Scrapper constructor.
     * @param Client $client
     * @param array $scrappers
     */
    public function __construct(Client $client, ?array $scrappers)
    {
        $this->scrappers = $scrappers;
    }

    /**
     * @return array|null
     */
    public function isValidScrapper(String $name): bool {
        return in_array($name, $this->scrappers);
    }
}