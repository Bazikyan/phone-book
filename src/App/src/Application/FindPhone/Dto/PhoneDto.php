<?php


namespace App\Application\FindPhone\Dto;


use DateTimeImmutable;

class PhoneDto
{

    private string $id;

    private string $firstName;

    private string $phoneNumber;

    private ?string $lastName;

    private ?string $countryCode;

    private ?string $timezoneName;

    private DateTimeImmutable $insertedOn;

    private DateTimeImmutable $updatedOn;

    public function __construct(
        string $id,
        string $firstName,
        string $phoneNumber,
        ?string $lastName,
        ?string $countryCode,
        ?string $timezoneName,
        DateTimeImmutable $insertedOn,
        DateTimeImmutable $updatedOn
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->phoneNumber = $phoneNumber;
        $this->lastName = $lastName;
        $this->countryCode = $countryCode;
        $this->timezoneName = $timezoneName;
        $this->insertedOn = $insertedOn;
        $this->updatedOn = $updatedOn;
    }

    public function toArray(): array
    {
        return [
            'type' => 'phones',
            'id' => $this->getId(),
            'attributes' => [
                'first_name' => $this->getFirstName(),
                'last_name' => $this->getLastName(),
                'phone_number' => $this->getPhoneNumber(),
                'country_code' => $this->getCountryCode(),
                'timezone_name' => $this->getTimezoneName(),
                'inserted_on' => $this->getInsertedOn(),
                'updated_on' => $this->getUpdatedOn(),
            ],
        ];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @return string|null
     */
    public function getTimezoneName(): ?string
    {
        return $this->timezoneName;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getInsertedOn(): DateTimeImmutable
    {
        return $this->insertedOn;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdatedOn(): DateTimeImmutable
    {
        return $this->updatedOn;
    }
}