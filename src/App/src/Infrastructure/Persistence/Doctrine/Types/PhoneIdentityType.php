<?php


namespace App\Infrastructure\Persistence\Doctrine\Types;


use App\Domain\Model\PhoneIdentity;
use App\Infrastructure\Domain\Model\DoctrinePhoneIdentity;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class PhoneIdentityType extends Type
{

    const TYPE_NAME = 'phone_identity';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        dump($fieldDeclaration);die;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): PhoneIdentity
    {
        return new DoctrinePhoneIdentity($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return $value->id();
    }

    public function getName(): string
    {
        return self::TYPE_NAME;
    }
}