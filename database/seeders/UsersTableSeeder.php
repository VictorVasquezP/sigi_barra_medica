<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'name' => 'Support Technical',
                'email' => 'support@barra.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$OcioynGhUhKRn8bpcv3oFe7IpmH3l6eRmGb5vgN.0WD.zg66rtAk2',
                'remember_token' => 'Hos5s7nunJyGCkK1EkvfBDOV2ledn6na1Z3WmfQOuHbPwVQ6P62PJ3XSFDSR',
                'settings' => NULL,
                'created_at' => '2022-11-09 13:21:00',
                'updated_at' => '2022-11-09 13:21:00',
                'type_room_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 2,
                'name' => 'Administración',
                'email' => 'admin@barra.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Lwb8GXStTaoiN/OtDoUHaOZCWfBV2YhqBegdApjnshup90k4nuQG.',
                'remember_token' => NULL,
                'settings' => '{"locale":"es"}',
                'created_at' => '2023-01-29 18:52:39',
                'updated_at' => '2023-01-29 18:52:39',
                'type_room_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'role_id' => 3,
                'name' => 'Hospital',
                'email' => 'hospital@barra.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$zeSuZRREy5GZNiwY0VqVtuCpa.k6/Fj.Ga2lRvCYQlzUwKmWfpRX6',
                'remember_token' => NULL,
                'settings' => '{"locale":"es"}',
                'created_at' => '2023-01-29 18:53:06',
                'updated_at' => '2023-01-30 04:41:06',
                'type_room_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'role_id' => 5,
                'name' => 'Urgencias',
                'email' => 'urgencias@barra.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$SRNwP1465xh28kiajSPoh.IMdvyubsUs3o5Ruz7PEPzEXVzaPAcK2',
                'remember_token' => NULL,
                'settings' => '{"locale":"es"}',
                'created_at' => '2023-01-30 04:36:41',
                'updated_at' => '2023-01-30 04:36:41',
                'type_room_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'role_id' => 4,
                'name' => 'Quirófano',
                'email' => 'quirofano@barra.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$9.yXuplmDbQM3Lzl.Hs.mujNSBgCbIt467EhVXUw//eo3yWVDHlIe',
                'remember_token' => NULL,
                'settings' => '{"locale":"es"}',
                'created_at' => '2023-01-30 04:40:52',
                'updated_at' => '2023-01-30 04:40:52',
                'type_room_id' => NULL,
            ),
        ));
        
        
    }
}