<?php

namespace App\Repository;

use App\Entity\Attributions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Attributions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attributions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attributions[]    findAll()
 * @method Attributions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attributions::class);
    }

    // /**
    //  * @return Attributions[] Returns an array of Attributions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function findAll()
    {
      /*
       return $this->createQueryBuilder('a')
        ->select('a')
      // ->Join("App:Postes","p")
     ->Join("App:Clients","c","WITH","c.id=a.clientId")
     ->addSelect('c')
            ->getQuery()
            ->getResult();*/
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
                "SELECT p,a,c from App:Attributions a join a.posteId as p with a.posteId=p.id join a.clientId c with a.clientId=c.id"
        );
    
            // returns an array of Product objects
            return $query->getArrayResult();
    }
       
    /*
    public function findOneBySomeField($value): ?Attributions
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
