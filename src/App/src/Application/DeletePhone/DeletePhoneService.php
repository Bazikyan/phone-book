<?php


namespace App\Application\DeletePhone;


use App\Domain\Model\PhoneIdentityFactory;
use App\Domain\Model\PhoneRepository;

class DeletePhoneService
{

    protected PhoneRepository $repository;

    protected PhoneIdentityFactory $phoneIdentityFactory;

    public function __construct(PhoneRepository $repository, PhoneIdentityFactory $phoneIdentityFactory)
    {
        $this->repository = $repository;
        $this->phoneIdentityFactory = $phoneIdentityFactory;
    }

    public function execute(DeletePhoneRequest $request): void
    {
        $id = $this->getPhoneIdentityFactory()->create($request->getId());

        $this->getRepository()->remove($id);
    }


    protected function getRepository(): PhoneRepository
    {
        return $this->repository;
    }

    protected function getPhoneIdentityFactory(): PhoneIdentityFactory
    {
        return $this->phoneIdentityFactory;
    }
}