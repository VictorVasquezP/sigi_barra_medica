<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'created_at' => '2022-11-09 13:18:29',
                'display_name' => 'Soporte',
                'id' => 1,
                'name' => 'support',
                'updated_at' => '2022-11-09 14:03:47',
            ),
            1 => 
            array (
                'created_at' => '2022-11-09 13:18:29',
                'display_name' => 'Administrador',
                'id' => 2,
                'name' => 'admin',
                'updated_at' => '2022-11-09 14:06:03',
            ),
            2 => 
            array (
                'created_at' => '2023-01-19 19:17:14',
                'display_name' => 'Hospitalización',
                'id' => 3,
                'name' => 'hospital',
                'updated_at' => '2023-01-19 19:17:14',
            ),
            3 => 
            array (
                'created_at' => '2023-01-19 19:17:14',
                'display_name' => 'Quirófano',
                'id' => 4,
                'name' => 'quirofano',
                'updated_at' => '2023-01-19 19:17:14',
            ),
            4 => 
            array (
                'created_at' => '2023-01-19 19:17:14',
                'display_name' => 'Urgencias',
                'id' => 5,
                'name' => 'urgencias',
                'updated_at' => '2023-01-19 19:17:14',
            ),
        ));
        
        
    }
}