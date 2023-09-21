<?php
namespace App\Domain\Repository;

interface AuctionRepository {
    public function findWinnerByAuctionId();
}