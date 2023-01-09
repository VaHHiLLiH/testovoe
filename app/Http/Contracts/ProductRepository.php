<?php

namespace App\Http\Contracts;

interface ProductRepository
{
    public function getCountProductsFromCategory(int $category_id);

    public function getPieceProductsFromCategory(int $category_id, int $from, int $count);

    public function getAllProductsFromCategory(int $category_id);
}

