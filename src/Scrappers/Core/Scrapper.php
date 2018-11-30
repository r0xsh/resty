<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 14:56
 */

namespace App\Scrappers\Core;


use App\Scrappers\Core\Exceptions\ScrapperException;
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
     * Check if the scrappers exists
     * @param String $name
     * @return bool
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

    /**
     * @param string $scrapper
     * @param string $handle
     * @return BaseScrapper
     * @throws ScrapperException
     */
    public function scrap(string $scrapper, string $handle): BaseScrapper {

        if ($this->isValidScrapper($scrapper) && $this->container->has($this->scrappers[$scrapper])) {
            /** @var BaseScrapper $scrapperObj */
            $scrapperObj = $this->container->get($this->scrappers[$scrapper]);

            $scrapperObj->setBody(
                $this->http->get(
                    $scrapperObj->generateUrl($handle)
                )->getBody()->getContents()
            );

            return $scrapperObj;

        } else {
            throw new ScrapperException(sprintf('The scrapper named "%s" does not exists', $scrapper), 404);
        }
    }
}