<?php

namespace App\Repository;

use App\Entity\KqueUnite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method KqueUnite|null find($id, $lockMode = null, $lockVersion = null)
 * @method KqueUnite|null findOneBy(array $criteria, array $orderBy = null)
 * @method KqueUnite[]    findAll()
 * @method KqueUnite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KqueUniteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, KqueUnite::class);
    }

//    /**
//     * @return KqueUnite[] Returns an array of KqueUnite objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?KqueUnite
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
