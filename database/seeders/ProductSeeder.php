<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'mensal',
                'price' => 10,
                'description' => 'Subscrição Mensal',
                'excerpt' => 'Esta subscrição mensal permite o uso da plataforma sem restrições durante o proximo mes.',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'semestral',
                'price' => 48,
                'description' => 'Subscrição Semestral',
                'excerpt' => 'Esta subscrição semestral permite o uso da plataforma sem restrições durante os proximos 6 meses.',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'anual',
                'price' => '84',
                'description' => 'Subscrição Anual',
                'excerpt' => 'Esta subscrição anual permite o uso da plataforma sem restrições durante os proximos 12 meses',
                'status' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}
