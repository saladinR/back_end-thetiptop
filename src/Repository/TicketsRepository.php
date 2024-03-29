<?php

namespace App\Repository;

use App\Entity\Tickets;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tickets>
 *
 * @method Tickets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tickets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tickets[]    findAll()
 * @method Tickets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tickets::class);
    }

    public function findHistoryByClient(User $client)
    {
        return $this->createQueryBuilder('t')
            ->join('t.gain', 'g') // Join with the gains table using the 'gain' relationship
            ->select('t.numero as ticketNumero', 'g.description as gainDescription', 'IDENTITY(t.client) as userId', 't.createdAt as dateTirage')
            ->where('IDENTITY(t.client) = :clientId') 
            ->andWhere('t.utilise = true')
            ->setParameter('clientId', $client->getId())
            ->getQuery()
            ->getResult();
    }
    
    
    
    
    

//    /**
//     * @return Tickets[] Returns an array of Tickets objects
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

//    public function findOneBySomeField($value): ?Tickets
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
