<?php
namespace App\Application\Auction\Response;

use App\Domain\Entity\Bid;
use App\Domain\Entity\Buyer;
use PHPUnit\Framework\TestCase;

class GetAuctionWinnerResponseTest extends TestCase
{
    public function testGetBuyer()
    {
        $buyer = $this->createMock(Buyer::class);

        $bid = $this->createMock(Bid::class);

        $response = new GetAuctionWinnerResponse($buyer, $bid);

        $this->assertSame($buyer, $response->getBuyer());
    }

    public function testGetBid()
    {
        $buyer = $this->createMock(Buyer::class);

        $bid = $this->createMock(Bid::class);

        $response = new GetAuctionWinnerResponse($buyer, $bid);

        $this->assertSame($bid, $response->getBid());
    }
}
