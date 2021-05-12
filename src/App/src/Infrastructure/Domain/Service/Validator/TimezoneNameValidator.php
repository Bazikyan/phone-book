<?php


namespace App\Infrastructure\Domain\Service\Validator;


use App\Domain\Service\TimezoneNameValidatorInterface;
use App\Infrastructure\Domain\Service\Validator\GuzzleRetriever\TimezoneNamesRetriever;

class TimezoneNameValidator extends AbstractValidator implements TimezoneNameValidatorInterface
{
    private TimezoneNamesRetriever $retriever;

    public function __construct(TimezoneNamesRetriever $retriever)
    {
        $this->retriever = $retriever;
    }

    protected function getRetriever(): TimezoneNamesRetriever
    {
        return $this->retriever;
    }
}