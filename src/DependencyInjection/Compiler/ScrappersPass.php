<?php
/**
 * Created by PhpStorm.
 * User: r0xsh
 * Date: 27/11/18
 * Time: 15:32
 */

namespace App\DependencyInjection\Compiler;


use Psr\Container\ContainerInterface;
use ReflectionClass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ScrappersPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {

        $scrappers = array_map(function ($scrapper) use (&$container){
            return strtolower((new ReflectionClass($container->get($scrapper)))->getShortName());
        }, array_keys($container->findTaggedServiceIds('scrappers')));

        $container->setParameter('scrappers.names', $scrappers);

    }
}