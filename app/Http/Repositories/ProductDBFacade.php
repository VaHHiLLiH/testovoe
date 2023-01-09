<?php

namespace App\Http\Repositories;

use App\Http\Contracts\ProductRepository;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Collection;

class ProductDBFacade implements ProductRepository
{
    public function getCountProductsFromCategory(int $category_id)
    {
        return DB::table('products')
            ->where('category_id', '=', $category_id)
            ->count();
    }

    public function getPieceProductsFromCategory(int $category_id, int $from, int $count)
    {
        return DB::table('products')
            ->where('category_id', '=', $category_id)
            ->skip($from)
            ->take($count)
            ->get();
    }

    public function getAllProductsFromCategory(int $category_id)
    {
        $count = $this->getCountProductsFromCategory($category_id);

        $countItem = 2;
        $currentList = 1;
        $maxList = ceil($count/$countItem);

        $allProducts = [];

        while($currentList <= $maxList) {
            $listProducts = $this->getPieceProductsFromCategory($category_id, (($currentList-1)*$countItem), $countItem);

            foreach ($listProducts as $product) {
                $allProducts[] = $product;
            }

            $currentList++;
        }
        return $allProducts;
    }
}
