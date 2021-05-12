<?php


namespace App\Application\FindPhone\ById;


use App\Application\FindPhone\ById\Exception\PhoneNotFoundException;
use App\Application\FindPhone\Dto\PhoneDto;
use App\Domain\Model\PhoneIdentityFactory;
use App\Domain\Model\PhoneRepository;

class FindPhoneByIdService
{

    protected PhoneRepository $repository;

    protected PhoneIdentityFactory $identityFactory;

    public function __construct(PhoneRepository $repository, PhoneIdentityFactory $identityFactory)
    {
        $this->repository = $repository;
        $this->identityFactory = $identityFactory;
    }

    public function execute(FindPhoneByIdRequest $request): PhoneDto
    {
        $identity = $this->getIdentityFactory()->create($request->getId());

        $phone = $this->getRepository()->findById($identity);
        if ($phone === null) {
            throw new PhoneNotFoundException('Phone not found for provided identity: ' . $identity->id());
        }

        return new PhoneDto(
            $phone->getId()->id(),
            $phone->getFirstName(),
            $phone->getPhoneNumber(),
            $phone->getLastName(),
            $phone->getCountryCode(),
            $phone->getTimezoneName(),
            $phone->getInsertedOn(),
            $phone->getUpdatedOn()
        );
    }

    protected function getRepository(): PhoneRepository
    {
        return $this->repository;
    }

    protected function getIdentityFactory(): PhoneIdentityFactory
    {
        return $this->identityFactory;
    }
}