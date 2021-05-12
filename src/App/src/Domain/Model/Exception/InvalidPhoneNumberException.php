<?php


namespace App\Domain\Model\Exception;


class InvalidPhoneNumberException extends \RuntimeException implements PhoneExceptionInterface
{

    public static function create(): self
    {
        return new self("Phone Number must start with '+' sign and contain 7-15 digits, also allowed ' ' and '-' signs between digits");
    }
}