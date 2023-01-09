<?php

namespace App\Http\Repositories;

use App\Http\Contracts\CategoryRepository;
use Illuminate\Support\Facades\DB;

class CategoryDBFacade implements CategoryRepository
{
    public function getCountCategories()
    {
        $category = DB::table();
    }

    public function getPieceCategories(int $from, int $count)
    {
        // TODO: Implement getPieceCategories() method.
    }

    public function getCategoryPath(int $category_id)
    {
        return DB::table('category_paths')
            ->where('category_id', $category_id)
            ->orderBy('step', 'desc')
            ->join('categories', 'categories.id', '=', 'category_paths.path_id')
            ->get(['name', 'slug']);
    }

    public function getCategoryChild(int $category_id)
    {
        return DB::table('categories')
            ->where('parent_id', '=', $category_id)
            ->get();
    }

}

