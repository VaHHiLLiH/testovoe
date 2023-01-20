<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class UserTokenGenerate
{
    public function generateApiToken()
    {
        $token = md5(microtime() . 'salt' . time());

        while (!$this->checkApiToken($token)) {
            $token = md5(microtime() . 'salt' . time());
        }

        return $token;
    }

    // TODO need refactor
    public function checkApiToken($token) {
        $checker = DB::table('users')
            ->where('api_token', '=', $token)
            ->get();
        if(!empty($checker->all())) {
            return false;
        }
        return true;
    }
}
