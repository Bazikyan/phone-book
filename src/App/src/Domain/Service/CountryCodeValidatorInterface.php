<?php


namespace App\Domain\Service;


interface CountryCodeValidatorInterface
{

    /**
     * Returns true if $countryCode is valid and false otherwise
     *
     * @param string $countryCode
     *
     * @return bool
     */
    public function isValid(string $countryCode): bool;
}