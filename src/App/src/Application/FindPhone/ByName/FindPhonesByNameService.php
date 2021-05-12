<?php


namespace App\Application\FindPhone\ByName;


use App\Application\FindPhone\Dto\PhoneDto;
use App\Application\FindPhone\Dto\PhoneDtoList;
use App\Domain\Model\Phone;
use App\Domain\Model\PhoneRepository;

class FindPhonesByNameService
{

    protected PhoneRepository $repository;

    public function __construct(PhoneRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(FindPhonesByNameRequest $request): PhoneDtoList
    {
        $phones = $this->getRepository()->findByName($request->getName());

        $phoneDtos = array_map(function (Phone $phone) {
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
        }, $phones);

        return new PhoneDtoList($phoneDtos);
    }

    protected function getRepository(): PhoneRepository
    {
        return $this->repository;
    }
}