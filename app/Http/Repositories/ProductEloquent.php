<?php

namespace App\Http\Repositories;

use App\Http\Contracts\ProductRepository;

class ProductEloquent implements ProductRepository
{
    public function getCountProductsFromCategory(int $category_id)
    {
        // TODO: Implement getCountProductsFromCategory() method.
    }

    public function getPieceProductsFromCategory(int $category_id, int $from, int $count)
    {
        // TODO: Implement getPieceProductsFromCategory() method.
    }

    public function getAllProductsFromCategory(int $category_id)
    {
        // TODO: Implement getAllProductsFromCategory() method.
    }
}
