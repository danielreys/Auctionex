<?php
namespace App\Domain\Entity;

class Buyer {
    private int $id;
    private string $name;
    private array $bids = [];

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getBids(): array
    {
        return $this->bids;
    }

    /**
     * @param array $bids
     */
    public function setBids(array $bids): void
    {
        $this->bids = $bids;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}