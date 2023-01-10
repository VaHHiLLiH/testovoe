<?php

namespace App\Http\Repositories;

use App\Http\Contracts\CategoryRepository;
use App\Models\Category;

class CategoryEloquent implements CategoryRepository
{
    public function getCountCategories()
    {
        // TODO: Implement getCountCategories() method.
    }

    public function getPieceCategories(int $from, int $count)
    {
        // TODO: Implement getPieceCategories() method.
    }

    public function getCategoryPath(int $category_id)
    {
        // TODO: Implement getCategoryPath() method.
    }

    public function getCategoryChild(int $category_id)
    {
        // TODO: Implement getCategoryChild() method.
    }

    public function getBreadcrumbs(Category $category)
    {
        // TODO: Implement getBreadcrumbs() method.
    }
}

