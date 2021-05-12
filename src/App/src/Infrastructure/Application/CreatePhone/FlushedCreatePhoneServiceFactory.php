<?php


namespace App\Infrastructure\Application\CreatePhone;


use App\Domain\Model\PhoneRepository;
use App\Domain\Service\CountryCodeValidatorInterface;
use App\Domain\Service\TimezoneNameValidatorInterface;
use App\Infrastructure\Persistence\Doctrine\PhoneBookEntityManager;
use Psr\Container\ContainerInterface;

class FlushedCreatePhoneServiceFactory
{

    public function __invoke(ContainerInterface $container): FlushedCreatePhoneService
    {
        return new FlushedCreatePhoneService(
            $container->get(PhoneRepository::class),
            $container->get(CountryCodeValidatorInterface::class),
            $container->get(TimezoneNameValidatorInterface::class),
            $container->get(PhoneBookEntityManager::class)
        );
    }
}