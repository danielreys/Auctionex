<?php
namespace App\Application\Service;

use App\Domain\Entity\Auction;
use App\Domain\Entity\Bid;
use App\Domain\Entity\Buyer;
use PHPUnit\Framework\TestCase;

class AuctionServiceTest extends TestCase
{
    public function testCalculateWinningBuyerAndBid()
    {
        $auction = $this->createMock(Auction::class);

        $buyer1 = $this->createMock(Buyer::class);
        $bidBuyer1 = $this->createMock(Bid::class);
        $bidBuyer1->method('getValue')->willReturn(120.5);

        $buyer2 = $this->createMock(Buyer::class);
        $bidBuyer2 = $this->createMock(Bid::class);
        $bidBuyer2->method('getValue')->willReturn(110.3);

        $auction->method('getBuyers')->willReturn([$buyer1, $buyer2]);
        $buyer1->method('getBids')->willReturn([$bidBuyer1]);
        $buyer2->method('getBids')->willReturn([$bidBuyer2]);

        $auctionService = new AuctionService();

        list($winningBuyer, $winningBid) = $auctionService->calculateWinningBuyerAndBid($auction);

        $this->assertSame($buyer1, $winningBuyer);
        $this->assertSame($bidBuyer1, $winningBid);
    }

    public function testCalculateWinningBuyerAndBidWithNoBids()
    {
        $auction = $this->createMock(Auction::class);

        $buyer1 = $this->createMock(Buyer::class);
        $buyer2 = $this->createMock(Buyer::class);

        $auction->method('getBuyers')->willReturn([$buyer1, $buyer2]);

        $auctionService = new AuctionService();

        list($winningBuyer, $winningBid) = $auctionService->calculateWinningBuyerAndBid($auction);

        $this->assertNull($winningBuyer);
        $this->assertNull($winningBid);
    }

    public function testCalculateWinningBuyerAndBidWithNoBuyersOrBids()
    {
        $auction = $this->createMock(Auction::class);

        $auction->method('getBuyers')->willReturn([]);

        $auctionService = new AuctionService();

        list($winningBuyer, $winningBid) = $auctionService->calculateWinningBuyerAndBid($auction);

        $this->assertNull($winningBuyer);
        $this->assertNull($winningBid);
    }

    public function testCalculateWinningBuyerAndBidWithEqualBids()
    {
        $auction = $this->createMock(Auction::class);

        $buyer1 = $this->createMock(Buyer::class);
        $bidBuyer1 = $this->createMock(Bid::class);

        $bidBuyer1->method('getValue')->willReturn(100.50);
        $bidBuyer1->method('getCreatedAt')->willReturn(new \DateTime('2023-09-21 10:00:00'));

        $buyer2 = $this->createMock(Buyer::class);
        $bidBuyer2 = $this->createMock(Bid::class);

        $bidBuyer2->method('getValue')->willReturn(100.50);
        $bidBuyer2->method('getCreatedAt')->willReturn(new \DateTime('2023-09-21 09:00:00'));

        $auction->method('getBuyers')->willReturn([$buyer1, $buyer2]);
        $buyer1->method('getBids')->willReturn([$bidBuyer1]);
        $buyer2->method('getBids')->willReturn([$bidBuyer2]);

        $auctionService = new AuctionService();

        list($winningBuyer, $winningBid) = $auctionService->calculateWinningBuyerAndBid($auction);

        $this->assertSame($buyer2, $winningBuyer);
        $this->assertSame($bidBuyer2, $winningBid);
    }
}
