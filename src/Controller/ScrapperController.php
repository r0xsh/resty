<?php

namespace App\Controller;

use App\Scrappers\Core\Exceptions\ScrapperException;
use App\Scrappers\Core\Scrapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
            array_reduce(array_keys($this->scraper->getScrappers()), function ($acc, $scrapper) {
                $acc[$scrapper] = $this->generateUrl('get_scrapper', ['scrapper' => $scrapper, 'handle' => '_handle_']);
                return $acc;
            }, [])
        );
    }

    /**
     * @Route("/scrapper/{scrapper}/{handle}", name="get_scrapper")
     * @param string $scrapper
     * @param string $handle
     * @return JsonResponse|Response
     * @throws \App\Scrappers\Core\Exceptions\ScrapperException
     */
    public function doScrap(string $scrapper, string $handle) {

        try {
            return new JsonResponse(
                $this->scraper->scrap($scrapper, $handle)
            );
        } catch (ScrapperException $e) {
            if ($e->getCode() == 404) {
                return new JsonResponse(['error' => true, 'message' => $e->getMessage()], 404);
            }
            throw $e;
        }


    }
}
