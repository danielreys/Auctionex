<?php
namespace App\Application\Auction\QueryHandler;

use App\Application\Auction\Query\GetAuctionWinnerQuery;
use App\Application\Auction\Response\GetAuctionWinnerResponse;
use App\Application\Service\AuctionService;
use App\Domain\Response\NoWinnerFound;

class GetAuctionWinnerQueryHandler {

    private AuctionService $auctionService;
    public function __construct(AuctionService $auctionService)
    {
        $this->auctionService = $auctionService;
    }


    public function handle(GetAuctionWinnerQuery $query): GetAuctionWinnerResponse| NoWinnerFound
    {
        list($winner, $price) = $this->auctionService->calculateWinningBuyerAndBid($query->getAuction());

        if (empty($winner) || empty($price)) {
            return new NoWinnerFound();
        }

        return new GetAuctionWinnerResponse($winner, $price);
    }

}
