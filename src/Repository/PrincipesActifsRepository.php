<?php

namespace App\Repository;

use App\Entity\PrincipesActifs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrincipesActifs|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrincipesActifs|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrincipesActifs[]    findAll()
 * @method PrincipesActifs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrincipesActifsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrincipesActifs::class);
    }

//    /**
//     * @return PrincipesActifs[] Returns an array of PrincipesActifs objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrincipesActifs
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
