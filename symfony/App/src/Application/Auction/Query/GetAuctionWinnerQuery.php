<?php
namespace App\Application\Auction\Query;

use App\Domain\Entity\Auction;

class GetAuctionWinnerQuery {
    private Auction $auction;

    public function __construct(Auction $auction) {
        $this->auction = $auction;
    }

    /**
     * @return Auction
     */
    public function getAuction(): Auction
    {
        return $this->auction;
    }
}
