<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }
    
    public function search(string $q, int $limit = 50): array
    {
        $qb = $this->createQueryBuilder('c');
        $expr = $qb->expr();
        
        return $qb
            ->orWhere($expr->like('c.firstName', ':q'))
            ->orWhere($expr->like('c.lastName', ':q'))
            ->orWhere($expr->like('c.email', ':q'))
            ->orWhere($expr->like('c.address', ':q'))
            ->orWhere($expr->like('c.city', ':q'))
            ->setParameter('q', "%{$q}%")
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult()
        ;
    }

    // /**
    //  * @return Contact[] Returns an array of Contact objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Contact
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
