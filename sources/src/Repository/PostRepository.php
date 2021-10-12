<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @return Exception|\Exception|\mixed[][]
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function getForSubscription($daysCount)
    {
        $query = 'SELECT * FROM post WHERE (CURRENT_TIMESTAMP - published_at) <= :daysCount';

        try {
            $stm = $this->getEntityManager()->getConnection()->prepare($query);
            $stm->bindValue(':daysCount', $daysCount);
            $result = $stm->executeQuery();

            return $result->fetchAllAssociative();
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
