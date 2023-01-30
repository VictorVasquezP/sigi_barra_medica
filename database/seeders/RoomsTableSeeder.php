<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rooms')->delete();
        
        \DB::table('rooms')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Cama 1',
                'type' => 1,
                'status_id' => 1,
                'created_at' => '2023-01-29 22:03:39',
                'updated_at' => '2023-01-29 22:03:39',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Cama 2',
                'type' => 1,
                'status_id' => 1,
                'created_at' => '2023-01-29 22:03:52',
                'updated_at' => '2023-01-29 22:03:52',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Cama 3',
                'type' => 1,
                'status_id' => 1,
                'created_at' => '2023-01-29 22:04:08',
                'updated_at' => '2023-01-29 22:04:30',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Cama 4',
                'type' => 1,
                'status_id' => 2,
                'created_at' => '2023-01-29 22:04:48',
                'updated_at' => '2023-01-29 22:07:54',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Cama 5',
                'type' => 1,
                'status_id' => 1,
                'created_at' => '2023-01-29 22:05:03',
                'updated_at' => '2023-01-29 22:05:03',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Cama 6',
                'type' => 1,
                'status_id' => 1,
                'created_at' => '2023-01-29 22:05:16',
                'updated_at' => '2023-01-29 22:05:16',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Cama 7',
                'type' => 1,
                'status_id' => 1,
                'created_at' => '2023-01-29 22:05:28',
                'updated_at' => '2023-01-29 22:05:28',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Cama 8',
                'type' => 1,
                'status_id' => 1,
                'created_at' => '2023-01-29 22:05:45',
                'updated_at' => '2023-01-29 22:05:45',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Cama 9',
                'type' => 1,
                'status_id' => 1,
                'created_at' => '2023-01-29 22:05:59',
                'updated_at' => '2023-01-29 22:05:59',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Cama 10',
                'type' => 1,
                'status_id' => 1,
                'created_at' => '2023-01-29 22:06:16',
                'updated_at' => '2023-01-29 22:06:16',
            ),
        ));
        
        
    }
}