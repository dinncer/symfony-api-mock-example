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

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getUsd(): ?float
    {
        return $this->usd;
    }

    /**
     * @param  float $usd
     * @return float
     */
    public function setUsd(float $usd): self
    {
        $this->usd = $usd;

        return $this;
    }

    /**
     * @return float
     */
    public function getEuro(): ?float
    {
        return $this->euro;
    }

    /**
     * @param  float $euro
     * @return float
     */
    public function setEuro(float $euro): self
    {
        $this->euro = $euro;

        return $this;
    }

    /**
     * @return float
     */
    public function getGbp(): ?float
    {
        return $this->gbp;
    }

    /**
     * @param  float $gbp
     * @return float
     */
    public function setGbp(float $gbp): self
    {
        $this->gbp = $gbp;

        return $this;
    }
}
