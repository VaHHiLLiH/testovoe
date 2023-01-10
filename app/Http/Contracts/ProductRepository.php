<?php

namespace App\Http\Contracts;

use App\Http\Repositories\CategoryDBFacade;
use App\Models\Category;
use App\Models\Product;

interface ProductRepository
{
    public function getCountProductsFromCategory(int $category_id);

    public function getPieceProductsFromCategory(int $category_id, int $from, int $count, ?string $sortable);

    public function getAllProductsFromCategory(int $category_id);

    public function getMaxList(int $category_id, int $from);

    public function getBreadcrumbs(Category $category, Product $product, CategoryDBFacade $categoryDBFacade);
}
