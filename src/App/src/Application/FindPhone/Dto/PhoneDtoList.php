<?php


namespace App\Application\FindPhone\Dto;


use Webmozart\Assert\Assert;

class PhoneDtoList
{

    private array $phoneList;

    public function __construct(array $phoneList)
    {
        $this->setPhoneList($phoneList);
    }

    public function toArray(): array
    {
        return array_map(function (PhoneDto $phoneDto) {
            return $phoneDto->toArray();
        }, $this->getPhoneList());
    }

    public function getPhoneList(): array
    {
        return $this->phoneList;
    }

    private function setPhoneList(array $phoneList): void
    {
        Assert::allIsInstanceOf($phoneList, PhoneDto::class);

        $this->phoneList = $phoneList;
    }
}