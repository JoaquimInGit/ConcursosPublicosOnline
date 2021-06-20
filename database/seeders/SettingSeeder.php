<?php

namespace Database\Seeders;

use App\Models\Product;
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
        /*Setting::getParam('product_id_aulas_grupos')
        if(!DB::table('settings')->where('slug','product_id_aulas_grupos')->exists()){
            DB::table('settings')->insert([
                [
                    'type' => Setting::TYPE_INTEGER,
                    'group' => 'orders',
                    'name' => 'Product Id das aulas de grupo',
                    'slug' => "product_id_aulas_grupos",
                    'options' => null,
                    'value' => '4',
                    'order' => 0,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
            ]);
        }*/

        //Setting::getParam('subscrição_mensal');
        if(!DB::table('settings')->where('slug','subscrição_mensal')->exists()){
            DB::table('settings')->insert([
                [
                    'type' => Setting::TYPE_INTEGER,
                    'group' => 'orders',
                    'name' => 'Subscrição mensal',
                    'slug' => "subscrição_mensal",
                    'options' => null,
                    'value' => '1',
                    'order' => 0,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
            ]);
        }
        //Setting::getParam('subscrição_mensal');
        if(!DB::table('settings')->where('slug','subscrição_semestral')->exists()){
            DB::table('settings')->insert([
                [
                    'type' => Setting::TYPE_INTEGER,
                    'group' => 'orders',
                    'name' => 'subscrição semestral',
                    'slug' => "subscrição_semestral",
                    'options' => null,
                    'value' => '2',
                    'order' => 0,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
            ]);
        }
        //Setting::getParam('subscrição_mensal');
        if(!DB::table('settings')->where('slug','subscrição_anual')->exists()){
            DB::table('settings')->insert([
                [
                    'type' => Setting::TYPE_INTEGER,
                    'group' => 'orders',
                    'name' => 'Subscrição anual',
                    'slug' => "subscrição_anual",
                    'options' => null,
                    'value' => '3',
                    'order' => 0,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
            ]);
        }

    }
}
