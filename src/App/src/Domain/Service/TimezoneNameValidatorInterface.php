<?php


namespace App\Domain\Service;


interface TimezoneNameValidatorInterface
{

    /**
     * Returns true if $timezoneName is valid and false otherwise
     *
     * @param string $timezoneName
     *
     * @return bool
     */
    public function isValid(string $timezoneName): bool;
}