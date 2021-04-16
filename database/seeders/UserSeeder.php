<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Fábio',
                'email' => 'fabio.ferreira@noop.pt',
                'email_verified_at' => date("Y-m-d H:i:s"),
                'password' => '$2y$10$MCsGWRkKnp1SmfonLifGd.oCrKJeO5UiaqgQZFc2.YNbEjW3kpdjK', //12345678
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}
