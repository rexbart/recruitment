<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Gwo\Recruitment\Entity;

/**
 * Description of Product
 *
 * @author Bartosz
 */
class Product
{
    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var int
     */
    private $unitPrice;

    /**
     *
     * @var int
     */
    private $minimumUnitPrice = 1;

    /**
     *
     * @var int
     */
    private $minimumQuantity = 1;

    /**
     *
     * @param int $id
     * @return \Gwo\Recruitment\Entity\Product
     */
    public function setId(int $id) : Product
    {
        $this->id = $id;

        return $this;
    }

    /**
     *
     * @return int|null
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     *
     * @param mixed $unitPrice
     * @return \Gwo\Recruitment\Entity\Product
     * @throws \InvalidArgumentException
     */
    public function setUnitPrice($unitPrice) : Product
    {
        if (false === $this->isUnitPriceValid($unitPrice)) {
            throw new \InvalidArgumentException();
        }

        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     *
     * @return int|null
     */
    public function getUnitPrice() : ?int
    {
        return $this->unitPrice;
    }

    /**
     *
     * @param int $unitPrice
     * @return \Gwo\Recruitment\Entity\Product
     * @throws \InvalidArgumentException
     */
    public function setMinimumUnitPrice(int $minimumUnitPrice) : Product
    {
        if (false === $this->isMinimumUnitPriceValid($minimumUnitPrice)) {
            throw new \InvalidArgumentException();
        }

        $this->minimumUnitPrice = $minimumUnitPrice;

        return $this;
    }

    /**
     *
     * @return int
     */
    public function getMinimumUnitPrice() : int
    {
        return $this->minimumUnitPrice;
    }

    /**
     *
     * @param int $quantity
     * @return \Gwo\Recruitment\Entity\Product
     * @throws \InvalidArgumentException
     */
    public function setMinimumQuantity(int $quantity) : Product
    {
        if (false === $this->isMinimumQuantityValid($quantity)) {
            throw new \InvalidArgumentException();
        }

        $this->minimumQuantity = $quantity;

        return $this;
    }

    /**
     *
     * @return int
     */
    public function getMinimumQuantity() : int
    {
        return $this->minimumQuantity;
    }

    /**
     *
     * @param int $quantity
     * @return bool
     */
    private function isMinimumQuantityValid(int $quantity) : bool
    {
        return $quantity >= $this->minimumQuantity;
    }

    /**
     *
     * @param int $unitPrice
     * @return bool
     */
    private function isUnitPriceValid(int $unitPrice) : bool
    {
        return $unitPrice > $this->minimumUnitPrice;
    }

    /**
     *
     * @param int $minimumUnitPrice
     * @return bool
     */
    private function isMinimumUnitPriceValid(int $minimumUnitPrice) : bool
    {
        return $minimumUnitPrice > 0;
    }
}
