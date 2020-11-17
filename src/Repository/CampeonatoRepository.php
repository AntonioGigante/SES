<?php

namespace App\Repository;

use App\Entity\Campeonato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Campeonatos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Campeonatos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Campeonatos[]    findAll()
 * @method Campeonatos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampeonatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Campeonato::class);
    }

    public function findAll()
    {
        $dql = 'SELECT c FROM App\Entity\Campeonato c';
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->execute();
    }

    // /**
    //  * @return Campeonatos[] Returns an array of Campeonatos objects
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
    public function findOneBySomeField($value): ?Campeonatos
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
