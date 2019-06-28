<?php

namespace App\Repository;

use App\Entity\NbStudent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NbStudent|null find($id, $lockMode = null, $lockVersion = null)
 * @method NbStudent|null findOneBy(array $criteria, array $orderBy = null)
 * @method NbStudent[]    findAll()
 * @method NbStudent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NbStudentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NbStudent::class);
    }

    // /**
    //  * @return NbStudent[] Returns an array of NbStudent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NbStudent
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
