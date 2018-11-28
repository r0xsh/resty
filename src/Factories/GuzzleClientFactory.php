<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 12:22
 */

namespace App\Factories;


use Doctrine\Common\Cache\FilesystemCache;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\DoctrineCacheStorage;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;

class GuzzleClientFactory
{

    public function build() {


        $stack = HandlerStack::create();

        $stack->push(
            new CacheMiddleware(
                new GreedyCacheStrategy(
                    new DoctrineCacheStorage(
                        new FilesystemCache('/tmp/')
                    ),
                    18000
                )
            ),
            'greedy-cache'
        );

        return new Client([
            'timeout' => 30,
            'verify' => false,
            //'proxy' => 'http://10.100.0.248:8080',
            'headers' => [
                'Referer' => 'http://google.fr',
                'Connection' => 'keep-alive',
                'Accept-Language' => 'en-US,en;q=0.5',
                'Accept-Encoding' => 'gzip, deflate',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'User-Agent' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:63.0) Gecko/20100101 Firefox/63.0'
            ],
            'handler' => $stack
        ]);
    }

}