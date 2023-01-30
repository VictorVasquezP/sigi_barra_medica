<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TypeRoomsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('type_rooms')->delete();
        
        \DB::table('type_rooms')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Quirófano',
                'created_at' => '2023-01-29 22:38:25',
                'updated_at' => '2023-01-30 04:06:44',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Hospitalización',
                'created_at' => '2023-01-30 04:07:04',
                'updated_at' => '2023-01-30 04:07:04',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Urgencias',
                'created_at' => '2023-01-30 04:07:14',
                'updated_at' => '2023-01-30 04:07:14',
            ),
        ));
        
        
    }
}