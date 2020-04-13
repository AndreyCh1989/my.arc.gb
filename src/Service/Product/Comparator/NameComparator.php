<?php


namespace Service\Product\Comparator;


use Model\Entity\Product;
use Service\Product\Contract\ProductComparatorInterface;

class NameComparator implements ProductComparatorInterface
{
    public function compare(Product $a, Product $b): int
    {
        return $a->getName() <=> $b->getName();
    }
}