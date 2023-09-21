<?php
namespace App\Infrastructure\Controller;

use App\Application\Auction\Query\GetAuctionWinnerQuery;
use App\Application\Auction\QueryHandler\GetAuctionWinnerQueryHandler;
use App\Domain\Entity\Auction;
use App\Domain\Entity\Bid;
use App\Domain\Entity\Buyer;
use App\Domain\Response\NoWinnerFound;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionController extends AbstractController
{
    private GetAuctionWinnerQueryHandler $auctionWinnerQueryHandler;
    public function __construct(GetAuctionWinnerQueryHandler $auctionWinnerQueryHandler)
    {
        $this->auctionWinnerQueryHandler = $auctionWinnerQueryHandler;
    }

    /**
     * @Route("/", name="auction_index")
     */

    public function index() : Response
    {

        $auction = new Auction(10);

        $buyer1 = new Buyer('Mark');
        $buyer2 = new Buyer('Steve');
        $buyer3 = new Buyer('Daniel');

        $buyer1->setBids([new Bid(18), new Bid(20), new Bid(25.5)]);
        $buyer2->setBids([new Bid(15), new Bid(17), new Bid(25.5)]);
        $buyer3->setBids([new Bid(12), new Bid(20), new Bid(24)]);

        $auction->addBuyers([$buyer1, $buyer2, $buyer3]);

        $query = new GetAuctionWinnerQuery($auction);

        $response = $this->auctionWinnerQueryHandler->handle($query);

        if ($response instanceof NoWinnerFound) {
            return $this->render('auction_no_winner.html.twig', [
                'auctionDate' => $auction->getCreatedAt()
            ]);
        }

        return $this->render('auction_winner.html.twig', [
            'winnerBid'   => $response->getBid(),
            'winner'      => $response->getBuyer(),
            'auctionDate' => $auction->getCreatedAt()
        ]);
    }
}