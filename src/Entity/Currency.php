<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CurrencyRepository")
 */
class Currency
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $usd;

    /**
     * @ORM\Column(type="float")
     */
    private $euro;

    /**
     * @ORM\Column(type="float")
     */
    private $gbp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsd(): ?float
    {
        return $this->usd;
    }

    public function setUsd(float $usd): self
    {
        $this->usd = $usd;

        return $this;
    }

    public function getEuro(): ?float
    {
        return $this->euro;
    }

    public function setEuro(float $euro): self
    {
        $this->euro = $euro;

        return $this;
    }

    public function getGbp(): ?float
    {
        return $this->gbp;
    }

    public function setGbp(float $gbp): self
    {
        $this->gbp = $gbp;

        return $this;
    }
}
