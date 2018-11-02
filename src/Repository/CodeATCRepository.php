<?php

namespace App\Repository;

use App\Entity\CodeATC;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CodeATC|null find($id, $lockMode = null, $lockVersion = null)
 * @method CodeATC|null findOneBy(array $criteria, array $orderBy = null)
 * @method CodeATC[]    findAll()
 * @method CodeATC[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodeATCRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CodeATC::class);
    }

//    /**
//     * @return CodeATC[] Returns an array of CodeATC objects
//     */
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
    public function findOneBySomeField($value): ?CodeATC
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
