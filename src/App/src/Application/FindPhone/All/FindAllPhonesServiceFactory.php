<?php


namespace App\Application\FindPhone\All;


use App\Domain\Model\PhoneRepository;
use Psr\Container\ContainerInterface;

class FindAllPhonesServiceFactory
{

    public function __invoke(ContainerInterface $container): FindAllPhonesService
    {
        return new FindAllPhonesService(
            $container->get(PhoneRepository::class)
        );
    }
}