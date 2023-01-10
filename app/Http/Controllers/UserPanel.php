<?php

namespace App\Http\Controllers;

use App\Http\Contracts\CategoryRepository;
use App\Http\Repositories\CategoryDBFacade;
use App\Http\Repositories\ProductDBFacade;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
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
        /*$product = Product::factory()->for(Category::factory()->create())->count(2)->create();
        dd($product->fresh());*/
    }

    public function index()
    {
        $categories = Category::all();

        return view('homePage', compact('categories'));
    }

    public function category(Category $category, CategoryDBFacade $categoryDBFacade, ProductDBFacade $productDBFacade)
    {
        $breadcrumbs = $categoryDBFacade->getBreadcrumbs($category);

        $productsCategory = $productDBFacade->getPieceProductsFromCategory($category->id, 0, 5, null);

        $childCategories = $categoryDBFacade->getCategoryChild($category->id);

        return view('categoryPage', compact('breadcrumbs', 'productsCategory', 'childCategories', 'category'));
    }

    public function showProduct(Product $product, ProductDBFacade $productDBFacade, CategoryDBFacade $categoryDBFacade)
    {
        $breadcrumbs = $productDBFacade->getBreadcrumbs(Category::find($product->category_id), $product, $categoryDBFacade);

        if (!empty($product->old_price)) {
            $product->discount_value = round((100 - ($product->price / ($product->old_price / 100))), 1);
        }

        return view('productPage', compact('breadcrumbs', 'product'));
    }

    public function registration()
    {
        return view('registration');
    }

    public function createUser(RegistrationRequest $registrationRequest)
    {
        dd($registrationRequest->all());
    }

    public function login()
    {
        return view('login');
    }

    public function loginUser(LoginRequest $loginRequest)
    {
        dd($loginRequest->all());
    }

    public function personalPage()
    {
         return view('personalPage');
    }




    public function getProductsForUser(Request $request, ProductDBFacade $productRepo)
    {
        return $productRepo->getPieceProductsFromCategory($request->category_id, ($request->from-1)*5, 5, $request->sortable);
    }

    public function getMaxList(Request $request, ProductDBFacade $productDBFacade)
    {
        return $productDBFacade->getMaxList($request->category_id, 5);
    }
}
