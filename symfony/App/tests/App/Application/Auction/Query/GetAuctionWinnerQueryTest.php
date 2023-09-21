<?php
namespace App\Application\Auction\Query;

use App\Domain\Entity\Auction;
use PHPUnit\Framework\TestCase;

class GetAuctionWinnerQueryTest extends TestCase
{
    public function testGetAuction()
    {
        $auction = $this->createMock(Auction::class);

        $query = new GetAuctionWinnerQuery($auction);

        $this->assertSame($auction, $query->getAuction());
    }
}