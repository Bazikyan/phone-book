<?php


namespace App\Infrastructure\Application\CreatePhone;


use App\Application\CreatePhone\CreatePhoneRequest;
use App\Application\CreatePhone\CreatePhoneResponse;
use App\Application\CreatePhone\CreatePhoneService;
use App\Domain\Model\PhoneRepository;
use App\Domain\Service\CountryCodeValidatorInterface;
use App\Domain\Service\TimezoneNameValidatorInterface;
use Doctrine\ORM\EntityManager;

class FlushedCreatePhoneService extends CreatePhoneService
{

    protected EntityManager $entityManager;

    public function __construct(
        PhoneRepository $phoneRepository,
        CountryCodeValidatorInterface $countryCodeValidator,
        TimezoneNameValidatorInterface $timezoneNameValidator,
        EntityManager $entityManager
    ) {
        parent::__construct($phoneRepository, $countryCodeValidator, $timezoneNameValidator);
        $this->entityManager = $entityManager;
    }

    public function execute(CreatePhoneRequest $request): CreatePhoneResponse
    {
        $response = parent::execute($request);

        $this->getEntityManager()->flush();

        return $response;
    }

    protected function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }
}