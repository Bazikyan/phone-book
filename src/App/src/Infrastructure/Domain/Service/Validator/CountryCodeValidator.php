<?php


namespace App\Infrastructure\Domain\Service\Validator;


use App\Domain\Service\CountryCodeValidatorInterface;
use App\Infrastructure\Domain\Service\Validator\GuzzleRetriever\CountryCodesRetriever;

class CountryCodeValidator extends AbstractValidator implements CountryCodeValidatorInterface
{
    private CountryCodesRetriever $retriever;

    public function __construct(CountryCodesRetriever $retriever)
    {
        $this->retriever = $retriever;
    }

    protected function getRetriever(): CountryCodesRetriever
    {
        return $this->retriever;
    }
}