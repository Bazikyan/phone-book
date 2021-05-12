<?php


namespace App\Application\FindPhone\ById;


use App\Domain\Model\PhoneIdentityFactory;
use App\Domain\Model\PhoneRepository;
use Psr\Container\ContainerInterface;

class FindPhoneByIdServiceFactory
{

    public function __invoke(ContainerInterface $container): FindPhoneByIdService
    {
        return new FindPhoneByIdService(
            $container->get(PhoneRepository::class),
            $container->get(PhoneIdentityFactory::class)
        );
    }
}