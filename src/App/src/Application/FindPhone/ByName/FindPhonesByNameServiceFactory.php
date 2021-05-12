<?php


namespace App\Application\FindPhone\ByName;


use App\Domain\Model\PhoneRepository;
use Psr\Container\ContainerInterface;

class FindPhonesByNameServiceFactory
{

    public function __invoke(ContainerInterface $container): FindPhonesByNameService
    {
        return new FindPhonesByNameService(
            $container->get(PhoneRepository::class)
        );
    }
}