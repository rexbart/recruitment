<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Gwo\Recruitment\Cart;

use Gwo\Recruitment\Entity\Product;
use Gwo\Recruitment\Cart\Exception\QuantityTooLowException;

/**
 * Description of Item
 *
 * @author Bartosz
 */
class Item
{
    /**
     *
     * @var Product
     */
    private $product;

    /**
     *
     * @var int
     */
    private $quantity;

    /**
     *
     * @param Product $product
     * @param int $quantity
     */
    public function __construct(Product $product, int $quantity = 1)
    {
        $this->setProduct($product);
        $this->setQuantity($quantity);
    }

    /**
     *
     * @param Product $product
     * @return \Gwo\Recruitment\Cart\Item
     */
    public function setProduct(Product $product) : Item
    {
        $this->product = $product;

        return $this;
    }

    /**
     *
     * @return Product
     */
    public function getProduct() : Product
    {
        return $this->product;
    }

    /**
     *
     * @param int $quantity
     * @return \Gwo\Recruitment\Cart\Item
     * @throws QuantityTooLowException
     */
    public function setQuantity(int $quantity) : Item
    {
        if (false === $this->isQuantityValid($quantity)) {
            throw new QuantityTooLowException();
        }

        $this->quantity = $quantity;

        return $this;
    }

    /**
     *
     * @param int $quantity
     * @return \Gwo\Recruitment\Cart\Item
     */
    public function addQuantity(int $quantity) : Item
    {
        return $this->setQuantity($this->quantity + $quantity);
    }

    /**
     *
     * @param int $quantity
     * @return \Gwo\Recruitment\Cart\Item
     */
    public function removeQuantity(int $quantity) : Item
    {
        return $this->setQuantity($this->quantity - $quantity);
    }

    /**
     *
     * @return int
     */
    public function getQuantity() : int
    {
        return $this->quantity;
    }

    /**
     *
     * @param int $quantity
     * @return bool
     */
    private function isQuantityValid(int $quantity) : bool
    {
        return $quantity >= $this->product->getMinimumQuantity();
    }

    /**
     *
     * @return int
     */
    public function getTotalPrice() : int
    {
        return $this->product->getUnitPrice() * $this->quantity;
    }
}
