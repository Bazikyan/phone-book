<?php


namespace App\Domain\Model;


interface PhoneIdentityFactory
{

    public function create(?string $id = null): PhoneIdentity;
}