<?php
namespace App\Application\Auction\QueryHandler;

use App\Application\Auction\Query\GetAuctionWinnerQuery;
use App\Application\Auction\Response\GetAuctionWinnerResponse;
use App\Application\Service\AuctionService;
use App\Domain\Entity\Auction;
use App\Domain\Entity\Bid;
use App\Domain\Entity\Buyer;
use App\Domain\Response\NoWinnerFound;
use PHPUnit\Framework\TestCase;

class GetAuctionWinnerQueryHandlerTest extends TestCase
{
    public function testHandle()
    {
        $auctionService = $this->createMock(AuctionService::class);

        $auction = $this->createMock(Auction::class);

        $expectedWinner = $this->createMock(Buyer::class);
        $expectedWinningPrice = $this->createMock(Bid::class);

        $auctionService->expects($this->once())
            ->method('calculateWinningBuyerAndBid')
            ->with($auction)
            ->willReturn([$expectedWinner, $expectedWinningPrice]);

        $handler = new GetAuctionWinnerQueryHandler($auctionService);

        $query = new GetAuctionWinnerQuery($auction);

        $response = $handler->handle($query);

        $this->assertInstanceOf(GetAuctionWinnerResponse::class, $response);
        $this->assertSame($expectedWinner, $response->getBuyer());
        $this->assertSame($expectedWinningPrice, $response->getBid());
    }

    public function testAuctionServiceReturnsNullWinner()
    {
        $auctionService = $this->createMock(AuctionService::class);

        $auction = $this->createMock(Auction::class);

        $expectedWinner = $this->createMock(Buyer::class);
        $expectedWinningPrice = $this->createMock(Bid::class);

        $auctionService->expects($this->once())
            ->method('calculateWinningBuyerAndBid')
            ->with($auction)
            ->willReturn([$expectedWinner, $expectedWinningPrice]);

        $handler = new GetAuctionWinnerQueryHandler($auctionService);

        $query = new GetAuctionWinnerQuery($auction);

        $response = $handler->handle($query);

        $this->assertInstanceOf(GetAuctionWinnerResponse::class, $response);
        $this->assertSame($expectedWinner, $response->getBuyer());
        $this->assertSame($expectedWinningPrice, $response->getBid());
    }

    public function testExceptionService()
    {
        $auctionService = $this->createMock(AuctionService::class);

        $auction = $this->createMock(Auction::class);

        $auctionService->expects($this->once())
            ->method('calculateWinningBuyerAndBid')
            ->with($auction)
            ->willThrowException(new \Exception('Auction service error'));

        $handler = new GetAuctionWinnerQueryHandler($auctionService);

        $query = new GetAuctionWinnerQuery($auction);

        $this->expectException(\Exception::class);
        $handler->handle($query);
    }

    public function testEmptyAuction()
    {
        $auctionService = $this->createMock(AuctionService::class);

        $auction = $this->createMock(Auction::class);

        $auctionService->expects($this->once())
            ->method('calculateWinningBuyerAndBid')
            ->with($auction)
            ->willReturn([null, null]);

        $handler = new GetAuctionWinnerQueryHandler($auctionService);

        $query = new GetAuctionWinnerQuery($auction);

        $response = $handler->handle($query);

        $this->assertInstanceOf(NoWinnerFound::class, $response);
    }
}