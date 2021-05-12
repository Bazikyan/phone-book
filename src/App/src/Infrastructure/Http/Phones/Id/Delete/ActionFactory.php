<?php


namespace App\Infrastructure\Http\Phones\Id\Delete;


use App\Application\DeletePhone\DeletePhoneService;
use Psr\Container\ContainerInterface;

class ActionFactory
{

    public function __invoke(ContainerInterface $container): Action
    {
        return new Action(
            $container->get(DeletePhoneService::class),
            $container->get(Responder::class)
        );
    }
}