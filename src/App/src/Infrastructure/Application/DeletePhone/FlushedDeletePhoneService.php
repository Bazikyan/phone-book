<?php


namespace App\Infrastructure\Application\DeletePhone;


use App\Application\DeletePhone\DeletePhoneRequest;
use App\Application\DeletePhone\DeletePhoneService;
use App\Domain\Model\PhoneIdentityFactory;
use App\Domain\Model\PhoneRepository;
use Doctrine\ORM\EntityManager;

class FlushedDeletePhoneService extends DeletePhoneService
{

    private EntityManager $entityManager;

    public function __construct(
        PhoneRepository $repository,
        PhoneIdentityFactory $phoneIdentityFactory,
        EntityManager $entityManager
    ) {
        parent::__construct($repository, $phoneIdentityFactory);
        $this->entityManager = $entityManager;
    }

    public function execute(DeletePhoneRequest $request): void
    {
        parent::execute($request);

        $this->getEntityManager()->flush();
    }

    private function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }


}