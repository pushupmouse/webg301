<?php

namespace App\Repository;

use App\Entity\Laptop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Laptop>
 *
 * @method Laptop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Laptop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Laptop[]    findAll()
 * @method Laptop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LaptopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Laptop::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Laptop $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Laptop $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // public function sortLaptopByIdAsc()
    // {
    //     return $this->createQueryBuilder('laptop')
    //         ->orderBy('laptop.id', 'ASC')
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
    
    // public function sortLaptopByIdDesc()
    // {
    //     return $this->createQueryBuilder('laptop')
    //         ->orderBy('laptop.id', 'DESC')
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }


    // public function sortLaptopByPriceDesc()
    // {
    //     return $this->createQueryBuilder('l')
    //         ->orderBy('laptop.price', 'DESC')
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    public function searchLaptop($keyword)
    {
        return $this->createQueryBuilder('laptop')
            ->andWhere('laptop.name LIKE :keyword')
            ->setParameter('keyword', '%' . $keyword .'%')
            ->orderBy('laptop.price', 'ASC')
            ->setMaxResults(12)
            ->getQuery()
            ->getResult()
        ;
    }
    // /**
    //  * @return Laptop[] Returns an array of Laptop objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Laptop
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
