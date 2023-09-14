<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function quote() {
        $url ='https://api.chucknorris.io/jokes/random';
        $chuckNorris = Http::get($url);
        $response = json_decode($chuckNorris->getBody());

        return response()->json([
            "status" => true,
            "quote" => $response->value,
            "source" => $response,
        ], 200);
    }

    public function transaction() {
        $transaction = DB::table('transactions')
            ->select('trx_id', 'amount')
            ->get();

        return response()->json([
            $transaction,
        ]);
    }

    public function getTransaction() {
        $transactionArray = array();
        
        $data = DB::table('users')
            ->leftJoin('balances', function($join) {
                $join->on('balances.user_id', '=', 'users.id');
            })
            ->leftJoin('transactions', function($join) {
                $join->on('users.id', '=', 'transactions.user_id');
            })
            ->select('*', 'users.name as user_name', 'users.id as user_id')
            ->get();

        

        return response()->json([
            "data" => $data,
        ]);
    }
}
