<?php


namespace App\Infrastructure\Application\UpdatePhone;


use App\Domain\Model\PhoneIdentityFactory;
use App\Domain\Model\PhoneRepository;
use App\Domain\Service\CountryCodeValidatorInterface;
use App\Domain\Service\TimezoneNameValidatorInterface;
use App\Infrastructure\Persistence\Doctrine\PhoneBookEntityManager;
use Psr\Container\ContainerInterface;

class FlushedUpdatePhoneServiceFactory
{

    public function __invoke(ContainerInterface $container): FlushedUpdatePhoneService
    {
        return new FlushedUpdatePhoneService(
            $container->get(PhoneRepository::class),
            $container->get(CountryCodeValidatorInterface::class),
            $container->get(TimezoneNameValidatorInterface::class),
            $container->get(PhoneIdentityFactory::class),
            $container->get(PhoneBookEntityManager::class),
        );
    }
}