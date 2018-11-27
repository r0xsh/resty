<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 12:22
 */

namespace App\Factories;


use GuzzleHttp\Client;

class GuzzleClientFactory
{

    public function build() {
        return new Client([
            'timeout' => 30,
            'verify' => false,
            //'proxy' => 'http://10.100.0.248:8080',
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:63.0) Gecko/20100101 Firefox/63.0'
            ]
        ]);
    }

}