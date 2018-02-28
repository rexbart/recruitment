<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Gwo\Recruitment\Cart;

use Gwo\Recruitment\Entity\Product;
use Gwo\Recruitment\Cart\Item;
use Gwo\Recruitment\Cart\Exception\QuantityTooLowException;

/**
 * Description of Cart
 *
 * @author Bartosz
 */
class Cart
{
    /**
     *
     * @var array
     */
    private $productIdToItem = [];

    /**
     *
     * @return array
     */
    public function getItems() : array
    {
        return array_values($this->productIdToItem);
    }

    /**
     *
     * @param int $index
     * @return Item
     * @throws \OutOfBoundsException
     */
    public function getItem(int $index) : Item
    {
        $items = $this->getItems();

        if (isset($items[$index])) {
            return $items[$index];
        } else {
            throw new \OutOfBoundsException();
        }
    }

    /**
     *
     * @param Product $product
     * @param int $quantity
     * @return \Gwo\Recruitment\Cart\Cart
     */
    public function addProduct(Product $product, int $quantity) : Cart
    {
        if (isset($this->productIdToItem[$product->getId()])) {
            $this->productIdToItem[$product->getId()]->addQuantity($quantity);
        } else {
            $this->productIdToItem[$product->getId()] = new Item($product, $quantity);
        }

        return $this;
    }

    /**
     *
     * @param Product $product
     * @param int $quantity
     * @return \Gwo\Recruitment\Cart\Cart
     */
    public function removeProduct(Product $product, int $quantity = 1) : Cart
    {
        try {
            $item = $this->productIdToItem[$product->getId()] ?? null;

            if ($item) {
                $item->removeQuantity($quantity);
            }
        } catch (QuantityTooLowException $ex) {
            unset($this->productIdToItem[$product->getId()]);
        }

        return $this;
    }

    /**
     *
     * @param Product $product
     * @param int $quantity
     * @return \Gwo\Recruitment\Cart\Cart
     */
    public function setQuantity(Product $product, int $quantity) : Cart
    {
        if (isset($this->productIdToItem[$product->getId()])) {
            $this->productIdToItem[$product->getId()]->setQuantity($quantity);
        } else {
            $this->productIdToItem[$product->getId()] = new Item($product, $quantity);
        }

        return $this;
    }

    /**
     *
     * @return int
     */
    public function getTotalPrice() : int
    {
        return array_reduce(
            $this->productIdToItem,
            function ($sum, $item) {
                return $sum + $item->getTotalPrice();
            },
            0
        );
    }
}
