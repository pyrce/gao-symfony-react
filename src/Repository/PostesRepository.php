<?php
namespace App\Repository;

use App\Entity\Postes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Computer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Computer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Computer[]    findAll()
 * @method Computer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Postes::class);
    }

    public function findAllQuery()
    {
        $query= $this->createQueryBuilder('c')
            ->select('c')
            // ->leftJoin("c.assigns", "cassign")
            // ->where("cassign.date LIKE :val")
            // ->setParameter("val", '%' . $date . '%')
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
          return $query;
    }

    public function findAllAndCount()
    {
        return $this->createQueryBuilder('c')
            ->select("count(c.id)")
            ->getQuery()
            ->getSingleScalarResult();
    }

    // /**
    //  * @return Computer[] Returns an array of Computer objects
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
    public function findOneBySomeField($value): ?Computer
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
?>