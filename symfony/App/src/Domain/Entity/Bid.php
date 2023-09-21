<?php
namespace App\Domain\Entity;

class Bid {
    private int $id;

    private float $value;

    private \DateTime $createdAt;


    /**
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->value = $value;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}