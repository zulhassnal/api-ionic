<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{
	public function login(Request $request){
		$email = $request->username;
		$password = $request->password;

		$user = \App\User::whereEmail($email)->first();
		if( ! $user ){
            $userData['data']['msg'] = 'ID Pengguna dan Kata Laluan Tidak Sah';
            return response()->json($userData);
        }
        $check_password = \Hash::check($password, $user->password);
        

        if( $check_password ){
            $userData['data']['msg'] = 'success';
            $userData['data']['userData'] = $user;
            return response()->json($userData);
        }else {
            $userData['data']['msg'] = 'ID Pengguna dan Kata Laluan Tidak Sah';
            return response()->json($userData);
        }
	}
	
	public function quotes(Request $request){
		$list = DB::table('quotes')->select('id','quotes', 'author', 'category')
		->where('author', '!=' , '')
		->limit(100)
		->groupBy('author')
		->get();
		return response()->json($list);
	}
}
