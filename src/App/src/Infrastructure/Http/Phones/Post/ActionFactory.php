<?php


namespace App\Infrastructure\Http\Phones\Post;


use App\Application\CreatePhone\CreatePhoneService;
use Psr\Container\ContainerInterface;

class ActionFactory
{

    public function __invoke(ContainerInterface $container): Action
    {
        return new Action(
            $container->get(CreatePhoneService::class),
            $container->get(Responder::class)
        );
    }
}