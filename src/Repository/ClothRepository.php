<?php

namespace App\Repository;

use App\Entity\Cloth;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cloth|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cloth|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cloth[]    findAll()
 * @method Cloth[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cloth::class);
    }

    /**
    * @return 4 random article objetcs
    */

    public function findRandom()
    {   
        $randomNumber = rand(0,45);
        $qb = $this->createQueryBuilder('c')
                   ->setMaxResults(4)
                   ->setFirstResult($randomNumber)
                   ->getQuery();

        return $qb->execute();           
    }

    /**
    * @return array of cloth objetc by size
    */
    public function findBySize($size, $category) {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT cloth
             FROM App\Entity\Cloth cloth
             JOIN cloth.sizes size
             WHERE size.name =:size 
             AND cloth.Type=:category'
        );
        $query->setParameters(array(
            'size' => $size,
            'category' => $category,
         ));
        return $query->getResult();
    }

    //SELECT cloth.name, size.name, cloth.type, cloth.price, cloth.picture, cloth.description FROM cloth_size JOIN size ON size.id = cloth_size.size_id JOIN cloth ON cloth.id = cloth_size.cloth_id WHERE size.name =:size AND cloth.type=:category; 

    // /**
    //  * @return Cloth[] Returns an array of Cloth objects
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
    public function findOneBySomeField($value): ?Cloth
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
