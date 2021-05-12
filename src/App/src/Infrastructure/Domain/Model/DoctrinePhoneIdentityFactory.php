<?php


namespace App\Infrastructure\Domain\Model;


use App\Domain\Model\PhoneIdentity;
use App\Domain\Model\PhoneIdentityFactory;

class DoctrinePhoneIdentityFactory implements PhoneIdentityFactory
{

    public function create(?string $id = null): PhoneIdentity
    {
        return DoctrinePhoneIdentity::create($id);
    }
}