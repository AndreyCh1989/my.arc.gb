<?php


namespace Service\Product\Contract;


use Model\Entity\Product;

interface ProductComparatorInterface
{
    public function compare(Product $a, Product $b): int;
}