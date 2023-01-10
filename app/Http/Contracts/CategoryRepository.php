<?php

namespace App\Http\Contracts;

use App\Models\Category;

interface CategoryRepository
{
    public function getCountCategories();

    public function getPieceCategories(int $from, int $count);

    public function getCategoryPath(int $category_id);

    public function getCategoryChild(int $category_id);

    public function getBreadcrumbs(Category $category);
}
