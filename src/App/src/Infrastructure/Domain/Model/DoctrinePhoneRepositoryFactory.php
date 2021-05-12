<?php


namespace App\Infrastructure\Domain\Model;


use App\Domain\Model\Phone;
use App\Infrastructure\Persistence\Doctrine\PhoneBookEntityManager;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class DoctrinePhoneRepositoryFactory
{

    public function __invoke(ContainerInterface $container): DoctrinePhoneRepository
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(PhoneBookEntityManager::class);

        /** @var DoctrinePhoneRepository $repository */
        $repository = $entityManager->getRepository(Phone::class);

        return $repository;
    }
}