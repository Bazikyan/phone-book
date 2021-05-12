<?php


namespace App\Infrastructure\Http\Phones\Get;


use App\Application\FindPhone\All\FindAllPhonesService;
use App\Application\FindPhone\ByName\FindPhonesByNameService;
use Psr\Container\ContainerInterface;

class ActionFactory
{

    public function __invoke(ContainerInterface $container): Action
    {
        return new Action(
            $container->get(FindAllPhonesService::class),
            $container->get(FindPhonesByNameService::class),
            $container->get(Responder::class)
        );
    }
}