<?php


namespace App\Infrastructure\Http\Phones\Id\Patch;


use App\Application\UpdatePhone\UpdatePhoneService;
use Psr\Container\ContainerInterface;

class ActionFactory
{

    public function __invoke(ContainerInterface $container): Action
    {
        return new Action(
            $container->get(UpdatePhoneService::class),
            $container->get(Responder::class)
        );
    }
}