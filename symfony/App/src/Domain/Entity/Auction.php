<?php

namespace App\Domain\Entity;

class Auction {
    private int $id;

    private float $reservePrice;

    private array $buyers = [];
    private \DateTime $createdAt;

    /**
     * @param float $reservePrice
     */
    public function __construct(float $reservePrice)
    {
        $this->reservePrice = $reservePrice;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getReservePrice(): float
    {
        return $this->reservePrice;
    }

    /**
     * @return array
     */
    public function getBuyers(): array
    {
        return $this->buyers;
    }

    /**
     * @param array $buyer
     */
    public function addBuyers(array $buyer): void
    {
        $this->buyers = $buyer;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }
}

