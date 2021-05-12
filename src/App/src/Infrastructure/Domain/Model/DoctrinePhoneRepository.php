<?php


namespace App\Infrastructure\Domain\Model;


use App\Domain\Model\Phone;
use App\Domain\Model\PhoneIdentity;
use App\Domain\Model\PhoneRepository;
use Doctrine\ORM\EntityRepository;

class DoctrinePhoneRepository extends EntityRepository implements PhoneRepository
{

    public function add(Phone $phone): void
    {
        $this->getEntityManager()->persist($phone);
    }

    public function remove(PhoneIdentity $identity): void
    {
        $phoneRef = $this->getEntityManager()->getReference(Phone::class, $identity);

        $this->getEntityManager()->remove($phoneRef);
    }

    public function findById(PhoneIdentity $identity): ?Phone
    {
        return $this->find($identity);
    }

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function findByName(string $name): array
    {
        $queryBuilder = $this->createQueryBuilder('p_b');
        $queryBuilder->select('p')
            ->from(Phone::class, 'p')
            ->where("p.firstName LIKE :name")
            ->orWhere("p.lastName LIKE :name")
            ->setParameter('name', '%' . $name . '%');

        return $queryBuilder->getQuery()->execute();
    }

    public function nextIdentity(): PhoneIdentity
    {
        return DoctrinePhoneIdentity::create();
    }
}