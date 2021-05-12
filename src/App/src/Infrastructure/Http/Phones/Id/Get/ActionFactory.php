<?php


namespace App\Infrastructure\Http\Phones\Id\Get;


use App\Application\FindPhone\ById\FindPhoneByIdService;
use Psr\Container\ContainerInterface;

class ActionFactory
{

    public function __invoke(ContainerInterface $container): Action
    {
        return new Action(
            $container->get(FindPhoneByIdService::class),
            $container->get(Responder::class)
        );
    }
}