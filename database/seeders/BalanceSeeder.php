<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        for($i = 0; $i < 5; $i ++) {
            $this->createData();
        }
    }

    public function createData() {
        $data = DB::table('balances')
            ->insert([
                "user_id" => 1,
                "amount_available" => rand(10000, 99999),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);
    }
}
