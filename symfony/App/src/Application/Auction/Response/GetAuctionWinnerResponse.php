<?php
namespace App\Application\Auction\Response;

use App\Domain\Entity\Bid;
use App\Domain\Entity\Buyer;

class GetAuctionWinnerResponse {
    private ?Buyer $buyer;
    private ?Bid $bid;

    public function __construct(?Buyer $buyer, ?Bid $bid) {
       $this->buyer = $buyer;
       $this->bid = $bid;
    }

    /**
     * @return Buyer|null
     */
    public function getBuyer(): ?Buyer
    {
        return $this->buyer;
    }

    /**
     * @return Bid|null
     */
    public function getBid(): ?Bid
    {
        return $this->bid;
    }
}
