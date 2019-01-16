<?php

namespace App\Repository;

use App\Entity\Currency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Currency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Currency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Currency[]    findAll()
 * @method Currency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyRepository extends ServiceEntityRepository
{
    /**
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Currency::class);
    }

    /**
     * The property for the lowest price.
     *
     * @return null
     */
    public function lowestPrice()
    {
        return $this->createQueryBuilder('q')
            ->select('q.id, MIN(q.usd) as usd, MIN(q.euro) as euro, MIN(q.gbp) as gbp')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
