<?php


namespace App\Infrastructure\Domain\Service\Validator;


use App\Infrastructure\Domain\Service\Validator\GuzzleRetriever\AbstractRetriever;

abstract class AbstractValidator
{

    public function isValid(string $stringToCheck): bool
    {
        $validStrings = $this->getRetriever()->retrieve();

        return in_array($stringToCheck, $validStrings);
    }

    abstract protected function getRetriever(): AbstractRetriever;
}