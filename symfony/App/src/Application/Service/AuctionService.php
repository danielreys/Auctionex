<?php
namespace App\Application\Service;

use App\Domain\Entity\Auction;
use App\Domain\Entity\Bid;
use App\Domain\Entity\Buyer;

class AuctionService
{
    public function calculateWinningBuyerAndBid(Auction $auction): array
    {
        $winningBuyer = null;
        $winningPrice = $auction->getReservePrice();
        $winningBid = null;

        foreach ($auction->getBuyers() as $buyer) {
            /** @var Buyer $buyer */
            foreach ($buyer->getBids() as $bid) {
                /** @var Bid $bid */
                if ($bid->getValue() > $winningPrice || ($bid->getValue() == $winningPrice && $bid->getCreatedAt() < $winningBid->getCreatedAt())) {
                    $winningBuyer = $buyer;
                    $winningPrice = $bid->getValue();
                    $winningBid = $bid;
                }
            }
        }

        return [$winningBuyer, $winningBid];
    }

}
