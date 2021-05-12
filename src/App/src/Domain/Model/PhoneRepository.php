<?php


namespace App\Domain\Model;


interface PhoneRepository
{

    public function add(Phone $phone): void;

    public function remove(PhoneIdentity $identity): void;

    public function findById(PhoneIdentity $identity): ?Phone;

    public function findAll(): array;

    public function findByName(string $name): array;

    public function nextIdentity(): PhoneIdentity;
}