<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductDBFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getAllProducts(Request $request, ProductDBFacade $productDBFacade)
    {
        if ($this->checkToken($request->get('token'))) {
            $array['data'] = $productDBFacade->getAllProducts();
            return json_encode($array);
        } else {
            $array['error'] = 'Invalid token';
            return json_encode($array);
        }
    }

    public function getPieceProducts(Request $request, ProductDBFacade $productDBFacade, $count)
    {
        if ($this->checkToken($request->get('token'))) {
            $array['data'] = $productDBFacade->getPieceProducts($count);
            return json_encode($array);
        } else {
            $array['error'] = 'Invalid token';
            return json_encode($array);
        }
    }

    public function getProductById(Request $request, ProductDBFacade $productDBFacade, $id)
    {
        if ($this->checkToken($request->get('token'))) {
            $array['data'] = $productDBFacade->getProductById($id);
            if (empty($array['data']->all())) {
                $array['error'] = 'no product with this id';
                unset($array['data']);
                return json_encode($array);
            } else {
                return json_encode($array);
            }
        } else {
            $array['error'] = 'Invalid token';
            return json_encode($array);
        }
    }

    public function checkToken($token)
    {
        $checker = DB::table('users')
            ->where('api_token', '=', $token)
            ->get();
        if(empty($checker->all())) {
            return false;
        } else {
            return true;
        }
    }
}
