<?php


namespace App\Infrastructure\Application\UpdatePhone;


use App\Application\UpdatePhone\UpdatePhoneRequest;
use App\Application\UpdatePhone\UpdatePhoneResponse;
use App\Application\UpdatePhone\UpdatePhoneService;
use App\Domain\Model\PhoneIdentityFactory;
use App\Domain\Model\PhoneRepository;
use App\Domain\Service\CountryCodeValidatorInterface;
use App\Domain\Service\TimezoneNameValidatorInterface;
use Doctrine\ORM\EntityManager;

class FlushedUpdatePhoneService extends UpdatePhoneService
{

    private EntityManager $entityManager;

    public function __construct(
        PhoneRepository $phoneRepository,
        CountryCodeValidatorInterface $countryCodeValidator,
        TimezoneNameValidatorInterface $timezoneNameValidator,
        PhoneIdentityFactory $phoneIdentityFactory,
        EntityManager $entityManager
    ) {
        parent::__construct($phoneRepository, $countryCodeValidator, $timezoneNameValidator, $phoneIdentityFactory);
        $this->entityManager = $entityManager;
    }

    public function execute(UpdatePhoneRequest $request): UpdatePhoneResponse
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