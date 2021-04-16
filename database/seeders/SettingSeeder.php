<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!DB::table('settings')->where('name','Email da plataforma')->exists()) {
            DB::table('settings')->insert([
                [
                    'type' => Setting::TYPE_TEXTFIELD,
                    'group' => 'main',
                    'name' => 'Email da plataforma',
                    'slug' => "email",
                    'options' => null,
                    'value' => 'geral@noop.pt',
                    'order' => 0,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]
            ]);
        }
    }
}
