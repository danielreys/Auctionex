<?php
namespace App\Infrastructure\Persistence\Doctrine;


use App\Domain\Entity\Auction;
use App\Domain\Repository\AuctionRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineOrderRepository implements AuctionRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findWinnerByAuctionId()
    {
        // TODO: Implement findWinnerByAuctionId() method.
    }
}