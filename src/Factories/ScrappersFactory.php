<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 12:09
 */

namespace App\Factories;

use App\Scrappers\Scrapper;
use GuzzleHttp\Client;

class ScrappersFactory
{

    public function build(Client $client, $scrappers)
    {
        return new Scrapper($client, $scrappers);
    }

}