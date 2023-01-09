<?php

namespace App\Http\Controllers;

use App\Http\Contracts\CategoryRepository;
use App\Http\Repositories\CategoryDBFacade;
use App\Http\Repositories\ProductDBFacade;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserPanel extends Controller
{
    public function test()
    {
        /*$category = Category::factory()->create();

        dd($category);*/

        /*$category = Category::create([
            'name'  => 'randomIZE_name',
            'parent_id' => 3,
        ]);
        dd($category);*/
        /*$category = Category::first();

        $category->update(['slug'   => Str::slug($category->name)]);*/

        //$category->save();
        /*$product = Product::factory()->for(Category::factory()->create())->create();
        dd($product->fresh());*/
    }

    public function index()
    {
        $categories = Category::all();

        return view('homePage', compact('categories'));
    }

    public function category(Category $category)
    {
        $class = new CategoryDBFacade();
        $path = $class->getCategoryPath($category->id);

        $breadcrumbs[] = [
            'name' => 'Home',
            'href' => route('home')
        ];

        foreach ($path as $path_category) {
            $breadcrumbs[] = [
                'name' => $path_category->name,
                'href' => route('showCategory', $path_category->slug)
            ];
        }

        $breadcrumbs[] = [
            'name' => $category->name,
            'href' => route('showCategory', $category->slug)
        ];
        //dd($breadcrumbs);
        $productRepo = new ProductDBFacade();

        $productsCategory = $productRepo->getPieceProductsFromCategory($category->id, 0, 5);

        foreach ($productsCategory as $key => $product) {

            if (!empty($product->discount_price)) {
                $product->discount = round(100 - ($product->discount_price / ($product->price / 100)), 2);
            }
        }
        $childCategories = $class->getCategoryChild($category->id);

        return view('categoryPage', compact('breadcrumbs', 'productsCategory', 'childCategories', 'category'));
    }

    public function getProductsForUser(Request $request)
    {
        var_dump('pomojka, ');
        dd('ya tut');

        $productRepo = new ProductDBFacade();

        return $productRepo->getPieceProductsFromCategory($request->category_id, $request->from*5, 5);
    }

}
