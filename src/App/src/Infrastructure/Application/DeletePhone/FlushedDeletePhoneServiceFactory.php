<?php


namespace App\Infrastructure\Application\DeletePhone;


use App\Domain\Model\PhoneIdentityFactory;
use App\Domain\Model\PhoneRepository;
use App\Infrastructure\Persistence\Doctrine\PhoneBookEntityManager;
use Psr\Container\ContainerInterface;

class FlushedDeletePhoneServiceFactory
{

    public function __invoke(ContainerInterface $container): FlushedDeletePhoneService
    {
        return new FlushedDeletePhoneService(
            $container->get(PhoneRepository::class),
            $container->get(PhoneIdentityFactory::class),
            $container->get(PhoneBookEntityManager::class)
        );
    }
}