# Auctionex
Auctinex is a web application using an algorithm to find the auction winner.

NOTE: you need docker installed in your computer.
## Instalation
After clonning the project you need to run the following command to build our docker images:
```bash
docker compose build
```
Now, let's get to the correct path, in this case, inside the symfony\App path.
We need to install composer to get the symfony dependencies right:

```bash
composer install
```
This will create the vendor directory.

NOTE: if you get a 502, just wait and reload a few seconds later.

## Application 
Go to :
```bash
ttp://localhost:8001/auction
```
In this route, you can see the application is working and giving you a person as the winner and the winner price (bid).
It follows the criteria given, I will explain later what is capable of and how it works.

The Application file distribution is based on following hexagonal architecture, just created Application, Domain and Infrastructure without placing it inside a context directly first only for simplification purposes. Instead I put the "Auction" context inside making clear about what part of our application is. 

![hexagonalArchitecture](https://github.com/danielreys/Auctionex/assets/43402051/700ab52b-8af2-410e-84bb-dd458edb349b)


## Algorithm 

It gets the result of an auction to check who the buyer and the final price (bid) is, it checks that is superior to the reserve price and gives the "win" to the first one that made the bid in case for some reason two buyers bidded the same amount. Then we return the result obtained.

```php
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
```
To test this more you can get to the following path and make more changes if you wish to do it manually. I created the auction and buyers there for simplification porpuses only:
```bash
Infrastructure/Controller/AuctionController.php
```

## Tests
Tests can be run for the application (where by now all tests created are):

```bash
vendor/bin/phpunit --testsuite "application"
```
There's a lot of them to make sure we are covering each possible scenario, not only the "happy path".

In case we want to create more suites is simple, just get to the phpunit.xml file and add another "testsuites"

![xmldist](https://github.com/danielreys/Auctionex/assets/43402051/336ce0a3-0710-44ec-9d5d-1d72482c6873)


## Considerations
Database was not required, but in future releases there could be repositories and actual read and update of values, where more use cases using CQRS and SOLID principles would be applied resulting in improvements.
The Symfony version used is the 6.3.4 which is a "Stable Release" in this moment.


