<?php

/*
 * This file is part of Secure Portal project.
 *      (c) AWS 2025 - 2025.
 *             All rights reserved.
 */

namespace App\Repository;

use App\Entity\MemberInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MemberInformation>
 */
class MemberInformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MemberInformation::class);
    }

    //    /**
    //     * @return MemberInformation[] Returns an array of MemberInformation objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?MemberInformation
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function getAllMemberInfo(): array
    {
        return $this->createQueryBuilder('m')
            ->select('m')
            ->getQuery()
            ->getResult();
    }
}
