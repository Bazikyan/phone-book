<?php

namespace App\Domain\Model;


use App\Domain\Model\Exception\EmptyFirstNameException;
use App\Domain\Model\Exception\EmptyPhoneNumberException;
use App\Domain\Model\Exception\InvalidCountryCodeException;
use App\Domain\Model\Exception\InvalidPhoneNumberException;
use App\Domain\Model\Exception\InvalidTimezoneNameException;
use App\Domain\Service\CountryCodeValidatorInterface;
use App\Domain\Service\TimezoneNameValidatorInterface;
use DateTimeImmutable;

class Phone
{
    /** @see InvalidPhoneNumberException::create method for information */
    private const PATTERN_PHONE_NUMBER = '/^\+(?:[0-9][ -]?){6,14}[0-9]$/';


    private PhoneIdentity $id;

    private string $firstName;

    private ?string $lastName;

    private string $phoneNumber;

    private ?string $countryCode;

    private ?string $timezoneName;

    private DateTimeImmutable $insertedOn;

    private DateTimeImmutable $updatedOn;

    public function __construct(PhoneIdentity $id, string $firstName, string $phoneNumber)
    {
        $this->id = $id;
        $this->setFirstName($firstName);
        $this->setPhoneNumber($phoneNumber);

        $this->setInsertedOnNow();
        $this->setUpdatedOnNow();
    }

    /**
     * @param string $firstName
     *
     * @throws EmptyFirstNameException if $firstName not provided
     */
    public function updateFirstName(string $firstName): void
    {
        $this->setFirstName($firstName);

        $this->setUpdatedOnNow();
    }

    public function updateLastName(?string $lastName): void
    {
        $this->setLastName($lastName);

        $this->setUpdatedOnNow();
    }

    /**
     * @param string $phoneNumber
     *
     * @throws InvalidPhoneNumberException
     */
    public function updatePhoneNumber(string $phoneNumber): void
    {
        $this->setPhoneNumber($phoneNumber);

        $this->setUpdatedOnNow();
    }

    /**
     * @param string|null $countryCode
     * @param CountryCodeValidatorInterface $validator
     *
     * @throws InvalidCountryCodeException
     */
    public function updateCountryCode(?string $countryCode, CountryCodeValidatorInterface $validator): void
    {
        $this->setCountryCode($countryCode, $validator);

        $this->setUpdatedOnNow();
    }

    /**
     * @param string|null $timezoneName
     * @param TimezoneNameValidatorInterface $validator
     *
     * @throws InvalidTimezoneNameException
     */
    public function updateTimezoneName(?string $timezoneName, TimezoneNameValidatorInterface $validator): void
    {
        $this->setTimezoneName($timezoneName, $validator);

        $this->setUpdatedOnNow();
    }


    public function getId(): PhoneIdentity
    {
        return $this->id;
    }


    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @throws EmptyFirstNameException if $firstName not provided
     */
    private function setFirstName(string $firstName): void
    {
        $firstName = trim($firstName);

        if (empty($firstName)) {
            throw new EmptyFirstNameException('First Name is required!');
        }

        $this->firstName = $firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    private function setLastName(?string $lastName): void
    {
        $this->lastName = null;

        if ($lastName === null) {

            return;
        }

        $lastName = trim($lastName);
        if (empty($lastName)) {

            return;
        }

        $this->lastName = $lastName;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @throws InvalidPhoneNumberException
     */
    private function setPhoneNumber(string $phoneNumber): void
    {
        $phoneNumber = trim($phoneNumber);
        if (empty($phoneNumber)) {
            throw new EmptyPhoneNumberException('Phone Number is required');
        }

        $phoneNumberIsValid = preg_match(self::PATTERN_PHONE_NUMBER, $phoneNumber) === 1;
        if (!$phoneNumberIsValid) {

            throw InvalidPhoneNumberException::create();
        }

        $this->phoneNumber = $phoneNumber;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param string|null $countryCode
     * @param CountryCodeValidatorInterface $validator
     *
     * @throws InvalidCountryCodeException
     */
    private function setCountryCode(?string $countryCode, CountryCodeValidatorInterface $validator): void
    {
        $countryCode = trim($countryCode);
        if (empty($countryCode)) {
            $this->countryCode = null;
        }

        if (!$validator->isValid($countryCode)) {
            throw new InvalidCountryCodeException('Country Code is invalid');
        }

        $this->countryCode = $countryCode;
    }

    public function getTimezoneName(): ?string
    {
        return $this->timezoneName;
    }

    /**
     * @param string|null $timezoneName
     * @param TimezoneNameValidatorInterface $validator
     *
     * @throws InvalidTimezoneNameException
     */
    private function setTimezoneName(?string $timezoneName, TimezoneNameValidatorInterface $validator): void
    {
        $timezoneName = trim($timezoneName);
        if (empty($timezoneName)) {
            $this->timezoneName = null;
        }

        if (!$validator->isValid($timezoneName)) {
            throw new InvalidTimezoneNameException('Timezone Name is invalid');
        }

        $this->timezoneName = $timezoneName;
    }

    public function getInsertedOn(): DateTimeImmutable
    {
        return $this->insertedOn;
    }

    private function setInsertedOnNow(): void
    {
        $this->insertedOn = new DateTimeImmutable();
    }

    public function getUpdatedOn(): DateTimeImmutable
    {
        return $this->updatedOn;
    }

    private function setUpdatedOnNow(): void
    {
        $this->updatedOn = new DateTimeImmutable();
    }


}