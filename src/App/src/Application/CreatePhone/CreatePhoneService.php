<?php


namespace App\Application\CreatePhone;


use App\Domain\Model\Phone;
use App\Domain\Model\PhoneRepository;
use App\Domain\Service\CountryCodeValidatorInterface;
use App\Domain\Service\TimezoneNameValidatorInterface;

class CreatePhoneService
{
    protected PhoneRepository $phoneRepository;

    protected CountryCodeValidatorInterface $countryCodeValidator;

    protected TimezoneNameValidatorInterface $timezoneNameValidator;


    public function __construct(
        PhoneRepository $phoneRepository,
        CountryCodeValidatorInterface $countryCodeValidator,
        TimezoneNameValidatorInterface $timezoneNameValidator
    ) {
        $this->phoneRepository = $phoneRepository;
        $this->countryCodeValidator = $countryCodeValidator;
        $this->timezoneNameValidator = $timezoneNameValidator;
    }

    public function execute(CreatePhoneRequest $request): CreatePhoneResponse
    {
        $phone = new Phone(
            $this->getPhoneRepository()->nextIdentity(),
            $request->getFirstName(),
            $request->getPhoneNumber()
        );

        if ($request->getLastName() !== null) {
            $phone->updateLastName($request->getLastName());
        }
        if ($request->getCountryCode() !== null) {
            $phone->updateCountryCode($request->getCountryCode(), $this->getCountryCodeValidator());
        }
        if ($request->getTimezoneName() !== null) {
            $phone->updateTimezoneName($request->getTimezoneName(), $this->getTimezoneNameValidator());
        }

        $this->getPhoneRepository()->add($phone);

        return new CreatePhoneResponse($phone->getId()->id());
    }

    protected function getPhoneRepository(): PhoneRepository
    {
        return $this->phoneRepository;
    }

    protected function getCountryCodeValidator(): CountryCodeValidatorInterface
    {
        return $this->countryCodeValidator;
    }

    protected function getTimezoneNameValidator(): TimezoneNameValidatorInterface
    {
        return $this->timezoneNameValidator;
    }
}