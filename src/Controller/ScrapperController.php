<?php

namespace App\Controller;

use App\Scrappers\Scrapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ScrapperController extends AbstractController
{


    /** @var Scrapper  */
    private $scraper;

    public function __construct(Scrapper $scrapper)
    {
        $this->scraper = $scrapper;
    }

    /**
     * @Route("/scrapper", name="scrapper")
     */
    public function index()
    {
        return $this->json(
            array_reduce($this->scraper->getScrappers(), function ($acc, $scrapper) {
                $acc[$scrapper] = '/scrapper/'.$scrapper.'/{handle}';
                return $acc;
            }, [])
        );
    }

    /**
     * @Route("/scrapper/{scrapper}/{handle}", name="get_scrapper")
     * @param string $scrapper
     * @param string $handle
     * @return JsonResponse
     */
    public function doScrap(string $scrapper, string $handle) {

        return new JsonResponse(
            $this->scraper->scrap($scrapper, $handle)
        );

    }
}
