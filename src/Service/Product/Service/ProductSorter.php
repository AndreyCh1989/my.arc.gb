<?php


namespace Service\Product\Service;


use Service\Product\Contract\ProductComparatorInterface;

class ProductSorter
{
    static public function sort(array $products, ProductComparatorInterface $comparator): array {
        usort($products, [$comparator, 'compare']);
        return $products;
    }
}