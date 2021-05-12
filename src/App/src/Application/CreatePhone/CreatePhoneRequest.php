<?php


namespace App\Application\CreatePhone;


class CreatePhoneRequest
{

    private string $firstName;

    private string $phoneNumber;

    private ?string $lastName;

    private ?string $countryCode;

    private ?string $timezoneName;

    public function __construct(
        string $firstName,
        string $phoneNumber,
        ?string $lastName = null,
        ?string $countryCode = null,
        ?string $timezoneName = null
    ) {
        $this->firstName = $firstName;
        $this->phoneNumber = $phoneNumber;
        $this->lastName = $lastName;
        $this->countryCode = $countryCode;
        $this->timezoneName = $timezoneName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function getTimezoneName(): ?string
    {
        return $this->timezoneName;
    }
}