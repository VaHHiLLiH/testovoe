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
        /*if ($this->checkToken($request->get('token'))) {
            $array['data'] = $productDBFacade->getAllProducts();
            return json_encode($array);
        } else {
            $array['error'] = 'Invalid token';
            return json_encode($array);
        }*/
        return $this->validation($request->get('token'), $productDBFacade->getAllProducts());
    }

    public function getPieceProducts(Request $request, ProductDBFacade $productDBFacade, $count)
    {
        /*if ($this->checkToken($request->get('token'))) {
            $array['data'] = $productDBFacade->getPieceProducts($count);
            return json_encode($array);
        } else {
            $array['error'] = 'Invalid token';
            return json_encode($array);
        }*/
        return $this->validation($request->get('token'), $productDBFacade->getPieceProducts($count));
    }

    public function getProductById(Request $request, ProductDBFacade $productDBFacade, $id)
    {
        /*if ($this->checkToken($request->get('token'))) {
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
        }*/
        $data = $this->validation($request->get('token'), $productDBFacade->getProductById($id));

        if (empty($data->getData()->error) && empty($data->getData()->data)) {
            return response()->json(['error' => 'No product with this id'], 404);
        }

        return $data;
    }

    public function checkToken($token)
    {
        $checker = DB::table('users')
            ->where('api_token', '=', $token)
            ->get();
        if(empty($checker->all())) {
            return false;
        }
        return true;
    }

    public function validation($token, $data)
    {
        if (!$this->checkToken($token)) {
            return response()->json(['error' => 'Invalid token'], 404);
        }
        return response()->json(['data' => $data], 200);
    }
}
