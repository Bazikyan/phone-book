<?php


namespace App\Application\UpdatePhone;


class UpdatePhoneResponse
{

    private string $id;


    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}