<?php

namespace App\Http\Repositories;

use App\Http\Contracts\ProductRepository;
use App\Models\Category;
use App\Models\Product;

class ProductEloquent implements ProductRepository
{
    public function getCountProductsFromCategory(int $category_id)
    {
        // TODO: Implement getCountProductsFromCategory() method.
    }

    public function getPieceProductsFromCategory(int $category_id, int $from, int $count, ?string $sortable)
    {
        // TODO: Implement getPieceProductsFromCategory() method.
    }

    public function getAllProductsFromCategory(int $category_id)
    {
        // TODO: Implement getAllProductsFromCategory() method.
    }

    public function getMaxList(int $category_id, int $from)
    {
        // TODO: Implement getMaxList() method.
    }

    public function getBreadcrumbs(Category $category, Product $product, CategoryDBFacade $categoryDBFacade)
    {
        // TODO: Implement getBreadcrumbs() method.
    }
}
