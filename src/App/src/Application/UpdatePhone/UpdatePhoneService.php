<?php


namespace App\Application\UpdatePhone;


use App\Application\UpdatePhone\Exception\PhoneDoesNotExistException;
use App\Domain\Model\Phone;
use App\Domain\Model\PhoneIdentityFactory;
use App\Domain\Model\PhoneRepository;
use App\Domain\Service\CountryCodeValidatorInterface;
use App\Domain\Service\TimezoneNameValidatorInterface;

class UpdatePhoneService
{

    protected PhoneRepository $phoneRepository;

    protected CountryCodeValidatorInterface $countryCodeValidator;

    protected TimezoneNameValidatorInterface $timezoneNameValidator;

    protected PhoneIdentityFactory $phoneIdentityFactory;


    public function __construct(
        PhoneRepository $phoneRepository,
        CountryCodeValidatorInterface $countryCodeValidator,
        TimezoneNameValidatorInterface $timezoneNameValidator,
        PhoneIdentityFactory $phoneIdentityFactory
    ) {
        $this->phoneRepository = $phoneRepository;
        $this->countryCodeValidator = $countryCodeValidator;
        $this->timezoneNameValidator = $timezoneNameValidator;
        $this->phoneIdentityFactory = $phoneIdentityFactory;
    }

    /**
     * @param UpdatePhoneRequest $request
     *
     * @return UpdatePhoneResponse
     *
     * @throws PhoneDoesNotExistException
     */
    public function execute(UpdatePhoneRequest $request): UpdatePhoneResponse
    {
        $phone = $this->findPhone($request);

        if (
            $request->hasAttribute($request::ATTRIBUTE_FIRST_NAME)
            && $phone->getFirstName() !== $request->getAttribute($request::ATTRIBUTE_FIRST_NAME)
        ) {
            $phone->updateFirstName($request->getAttribute($request::ATTRIBUTE_FIRST_NAME));
        }

        if (
            $request->hasAttribute($request::ATTRIBUTE_PHONE_NUMBER)
            && $phone->getPhoneNumber() !== $request->getAttribute($request::ATTRIBUTE_PHONE_NUMBER)
        ) {
            $phone->updatePhoneNumber($request->getAttribute($request::ATTRIBUTE_PHONE_NUMBER));
        }

        if (
            $request->hasAttribute($request::ATTRIBUTE_LAST_NAME)
            && $phone->getLastName() !== $request->getAttribute($request::ATTRIBUTE_LAST_NAME)
        ) {
            $phone->updateLastName($request->getAttribute($request::ATTRIBUTE_LAST_NAME));
        }

        if (
            $request->hasAttribute($request::ATTRIBUTE_COUNTRY_CODE)
            && $phone->getCountryCode() !== $request->getAttribute($request::ATTRIBUTE_COUNTRY_CODE)
        ) {
            $phone->updateCountryCode(
                $request->getAttribute($request::ATTRIBUTE_COUNTRY_CODE),
                $this->getCountryCodeValidator()
            );
        }

        if (
            $request->hasAttribute($request::ATTRIBUTE_TIMEZONE_NAME)
            && $phone->getTimezoneName() !== $request->getAttribute($request::ATTRIBUTE_TIMEZONE_NAME)
        ) {
            $phone->updateTimezoneName(
                $request->getAttribute($request::ATTRIBUTE_TIMEZONE_NAME),
                $this->getTimezoneNameValidator()
            );
        }

        return new UpdatePhoneResponse($request->getId());
    }

    /**
     * @param UpdatePhoneRequest $request
     *
     * @return Phone
     *
     * @throws PhoneDoesNotExistException
     */
    protected function findPhone(UpdatePhoneRequest $request): Phone
    {
        $id = $this->getPhoneIdentityFactory()->create($request->getId());
        $phone = $this->getPhoneRepository()->findById($id);
        if ($phone === null) {
            throw new PhoneDoesNotExistException('Phone with provided id does not exist: ' . $id->id());
        }

        return $phone;
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

    protected function getPhoneIdentityFactory(): PhoneIdentityFactory
    {
        return $this->phoneIdentityFactory;
    }
}