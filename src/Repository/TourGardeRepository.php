<?php

namespace App\Repository;

use App\Entity\TourGarde;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TourGarde|null find($id, $lockMode = null, $lockVersion = null)
 * @method TourGarde|null findOneBy(array $criteria, array $orderBy = null)
 * @method TourGarde[]    findAll()
 * @method TourGarde[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TourGardeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TourGarde::class);
    }

//    /**
//     * @return TourGarde[] Returns an array of TourGarde objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TourGarde
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
