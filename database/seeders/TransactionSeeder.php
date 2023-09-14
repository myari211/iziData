<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaction = DB::table('transactions')
            ->insert([
                "trx_id" => rand(111111, 99999),
                "amount" => 10000,
                "user_id" => 1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);
    }
}
