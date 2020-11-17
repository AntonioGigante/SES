<?php

namespace App\Repository;

use App\Entity\Equipo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Equipo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipo[]    findAll()
 * @method Equipo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipo::class);
    }

    // /**
    //  * @return Equipo[] Returns an array of Equipo objects
    //  */
    
    
    public function findByDirector($director): array
    {
        $sql = '
            SELECT * FROM equipo p
            WHERE p.director IN (SELECT username FROM user d WHERE p.director = d.username OR d.username IN d.miembros)
            ';
        
        $conn = $this->getEntityManager()->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute([array('director' => array($director))]); 

        return $stmt->fetchAll();
    }
    

    
    public function findOneBySomeField($director): ?Equipo
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('App\Entity\User', 'am', 'WITH', 'am.username=e.director')
            ->andWhere('e.director = :director')
            ->setParameter('director', $director)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
