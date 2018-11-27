<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 14:56
 */

namespace App\Scrappers;


use App\Scrappers\Core\BaseScrapper;
use GuzzleHttp\Client;
use Psr\Container\ContainerInterface;

class Scrapper
{

    private $scrappers;
    private $http;
    private $container;

    /**
     * Scrapper constructor.
     * @param Client $client
     * @param array $scrappers
     * @param ContainerInterface $container
     */
    public function __construct(Client $client, array $scrappers, ContainerInterface $container)
    {
        $this->http = $client;
        $this->scrappers = $scrappers;
        $this->container = $container;
    }

    /**
     * Check if the scrappers excists
     * @return array|null
     */
    public function isValidScrapper(String $name): bool {
        return array_key_exists($name, $this->scrappers);
    }

    /**
     * @return array|null
     */
    public function getScrappers(): ?array
    {
        return $this->scrappers;
    }

    public function scrap(string $scrapper, string $handle) {

        if ($this->isValidScrapper($scrapper) && $this->container->has($this->scrappers[$scrapper])) {
            /** @var BaseScrapper $scrapperObj */
            $scrapperObj = $this->container->get($this->scrappers[$scrapper]);

            $scrapperObj->setBody(
                $this->http->get($scrapperObj->generateUrl($handle))->getBody()->getContents()
            );

            return [
                'title' => $scrapperObj->title,
                'content' => $scrapperObj->content,
                'image' => $scrapperObj->mainImage
                ];



        } else {
            return ['error' => true];
        }
    }
}