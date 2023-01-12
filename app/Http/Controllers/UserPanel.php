<?php

namespace App\Http\Controllers;

use App\Http\Contracts\CategoryRepository;
use App\Http\Contracts\ProductRepository;
use App\Http\Repositories\CategoryDBFacade;
use App\Http\Repositories\ProductDBFacade;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Services\UserTokenGenerate;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        /*$product = Product::factory()->for(Category::factory()->create())->count(8)->create();
        dd($product->fresh());*/

        //Auth::logout();
    }

    public function index()
    {
        $categories = Category::all();

        return view('homePage', compact('categories'));
    }

    public function category(Category $category, CategoryRepository $categoryDBFacade, ProductRepository $productDBFacade)
    {
        $breadcrumbs = $categoryDBFacade->getBreadcrumbs($category);

        $productsCategory = $productDBFacade->getPieceProductsFromCategory($category->id, 0, 5, null);

        $childCategories = $categoryDBFacade->getCategoryChild($category->id);

        return view('categoryPage', compact('breadcrumbs', 'productsCategory', 'childCategories', 'category'));
    }

    public function showProduct(Product $product, ProductRepository $productDBFacade, CategoryRepository $categoryDBFacade)
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
        $user = User::create([
            'login' => $registrationRequest->get('login'),
            'email' => $registrationRequest->get('email'),
            'password' => Hash::make($registrationRequest->get('password')),
        ]);

        return redirect()->route('login');
    }

    public function login()
    {
        return view('login');
    }

    public function loginUser(LoginRequest $loginRequest)
    {
        if(Auth::attempt([
            'login' => $loginRequest->get('login'),
            'password' => $loginRequest->get('password'),
        ])) {
            return redirect()->route('personalPage');
        } else {
            return back()->withErrors([
                'login' => 'Допущена ошибка в логине или пароле',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function personalPage()
    {
        $user = Auth::user();

         return view('personalPage', compact('user'));
    }

    public function generateToken(UserTokenGenerate $userTokenGenerate)
    {
        $user = Auth::user();
        $user->update([
            'api_token' => $userTokenGenerate->generateApiToken(),
        ]);

        return redirect()->route('personalPage');
    }

    public function getProductsForUser(Request $request, ProductRepository $productRepo)
    {
        return $productRepo->getPieceProductsFromCategory($request->category_id, ($request->from-1)*5, 5, $request->sortable);
    }

    public function getMaxList(Request $request, ProductRepository $productDBFacade)
    {
        return $productDBFacade->getMaxList($request->category_id, 5);
    }
}
