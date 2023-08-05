<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        /*password: admin*/
        DB::table('users')->insert([
            'cedula' => 1101210215,
            'nombre' => 'Administrador',
            'email' => 'admin@admin.com',
            'celular' => '3003003030',
            'codigo_ciudad' => '8001',
            'fecha_nacimiento' => '1994-03-31',
            'password'=> '$2y$10$xrlfGAF.t./2o0pHbBGh2OYFlxg5d7pUlaNrycvCwmlg19hBeycC2',
            'is_admin' => true,
        ]);
    }
}
