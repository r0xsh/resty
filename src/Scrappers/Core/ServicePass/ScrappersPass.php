<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 15:32
 */

namespace App\Scrappers\Core\ServicePass;


use ReflectionClass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ScrappersPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {

        $scrappers = array_reduce(array_keys($container->findTaggedServiceIds('scrappers')),
            function ($acc, $scrapper) use (&$container){
            $acc[strtolower((new ReflectionClass($container->get($scrapper)))->getShortName())] = $scrapper;
            return $acc;
        }, []);

        $container->setParameter('scrappers.names', $scrappers);

    }
}