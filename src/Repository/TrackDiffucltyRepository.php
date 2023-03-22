<?php

namespace App\Repository;

use App\Entity\TrackDiffuclty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TrackDiffuclty>
 *
 * @method TrackDiffuclty|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrackDiffuclty|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrackDiffuclty[]    findAll()
 * @method TrackDiffuclty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrackDiffucltyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrackDiffuclty::class);
    }

    public function save(TrackDiffuclty $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TrackDiffuclty $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TrackDiffuclty[] Returns an array of TrackDiffuclty objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TrackDiffuclty
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
