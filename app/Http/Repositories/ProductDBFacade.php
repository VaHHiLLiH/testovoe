<?php

namespace App\Http\Repositories;

use App\Http\Contracts\CategoryRepository;
use App\Http\Contracts\ProductRepository;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductDBFacade implements ProductRepository
{
    public function getCountProductsFromCategory(int $category_id)
    {
        return DB::table('products')
            ->where('category_id', '=', $category_id)
            ->count();
    }

    // TODO NEED REFACTOR
    public function getPieceProductsFromCategory(int $category_id, int $from, int $count, ?string $sortable)
    {
        if (empty($sortable)) {
            return DB::table('products')
                ->select(DB::raw('*, ROUND(( 100 - ( `price` / ( `old_price` / 100 ))), 1) as discount_value'))
                ->where('category_id', '=', $category_id)
                ->skip($from)
                ->take($count)
                ->get();
        } else if ($sortable == 'price') {
            return DB::table('products')
                ->select(DB::raw('*, ROUND(( 100 - ( `price` / ( `old_price` / 100 ))), 1) as discount_value'))
                ->where('category_id', '=', $category_id)
                ->orderBy('price')
                ->skip($from)
                ->take($count)
                ->get();
        } else {
            return DB::table('products')
                ->select(DB::raw('*, ROUND(( 100 - ( `price` / ( `old_price` / 100 ))), 1) as discount_value'))
                ->where('category_id', '=', $category_id)
                ->orderBy('discount_value', 'desc')
                ->skip($from)
                ->take($count)
                ->get();
        }
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

    public function getMaxList(int $category_id, int $from)
    {
        // TODO NEED REFACTOR
       return ceil(DB::table('products')
            ->where('category_id', '=', $category_id)
            ->count()/$from);
    }

    public function getBreadcrumbs(Category $category, Product $product, CategoryRepository $categoryDBFacade)
    {
        $breadcrumbs = $categoryDBFacade->getBreadcrumbs($category);

         $breadcrumbs[] = [
            'name' => $product->name,
            'href' => route('showProduct', $product->slug),
        ];

        return $breadcrumbs;
    }

    // TODO NEED REFACTOR
    public function getAllProducts()
    {
        $count = DB::table('products')
            ->count();

        $countItem = 100;
        $currentList = 1;
        $maxList = ceil($count/$countItem);

        $allProducts = [];

        while($currentList <= $maxList) {
            $listProducts = DB::table('products')
                ->skip(($currentList-1)*$countItem)
                ->take($countItem)
                ->get();

            foreach ($listProducts as $product) {
                $allProducts[] = $product;
            }

            $currentList++;
        }
        return $allProducts;
    }

    // TODO NEED REFACTOR
    public function getPieceProducts($count)
    {
        if ($count > 100) {
            $countItem = 100;
        } else {
            $countItem = $count;
        }
        $currentList = 1;
        $maxList = ceil($count/$countItem);

        $allProducts = [];

        while($currentList <= $maxList) {
            $listProducts = DB::table('products')
                ->skip(($currentList-1)*$countItem)
                ->take($countItem)
                ->get();

            foreach ($listProducts as $product) {
                $allProducts[] = $product;
            }

            $currentList++;
        }
        return $allProducts;
    }

    // TODO NEED REFACTOR (FIRST instead GET)
    public function getProductById($product_id)
    {
        return DB::table('products')
            ->where('id', '=', $product_id)
            ->get();
    }
}
