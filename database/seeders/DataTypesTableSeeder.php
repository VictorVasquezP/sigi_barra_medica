<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DataTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_types')->delete();
        
        \DB::table('data_types')->insert(array (
            0 => 
            array (
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                'created_at' => '2022-11-09 13:18:29',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":"users"}',
                'display_name_plural' => 'Users',
                'display_name_singular' => 'User',
                'generate_permissions' => 1,
                'icon' => 'voyager-person',
                'id' => 1,
                'model_name' => 'App\\Models\\User',
                'name' => 'users',
                'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                'server_side' => 0,
                'slug' => 'users',
                'updated_at' => '2023-01-19 19:15:41',
            ),
            1 => 
            array (
                'controller' => '',
                'created_at' => '2022-11-09 13:18:29',
                'description' => '',
                'details' => NULL,
                'display_name_plural' => 'Menus',
                'display_name_singular' => 'Menu',
                'generate_permissions' => 1,
                'icon' => 'voyager-list',
                'id' => 2,
                'model_name' => 'TCG\\Voyager\\Models\\Menu',
                'name' => 'menus',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'menus',
                'updated_at' => '2022-11-09 13:18:29',
            ),
            2 => 
            array (
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                'created_at' => '2022-11-09 13:18:29',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":"roles"}',
                'display_name_plural' => 'Roles',
                'display_name_singular' => 'Role',
                'generate_permissions' => 1,
                'icon' => 'voyager-lock',
                'id' => 3,
                'model_name' => 'App\\Models\\Role',
                'name' => 'roles',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'roles',
                'updated_at' => '2022-11-09 14:02:45',
            ),
            3 => 
            array (
                'controller' => 'App\\Http\\Controllers\\RoomController',
                'created_at' => '2023-01-17 00:25:58',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'display_name_plural' => 'Habitaciones',
                'display_name_singular' => 'Habitación',
                'generate_permissions' => 1,
                'icon' => 'voyager-home',
                'id' => 4,
                'model_name' => 'App\\Models\\Room',
                'name' => 'rooms',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'rooms',
                'updated_at' => '2023-01-19 17:56:29',
            ),
            4 => 
            array (
                'controller' => NULL,
                'created_at' => '2023-01-17 00:27:55',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'display_name_plural' => 'Tipo de habitaciones',
                'display_name_singular' => 'Tipo de habitación',
                'generate_permissions' => 1,
                'icon' => 'voyager-double-right',
                'id' => 5,
                'model_name' => 'App\\Models\\TypeRoom',
                'name' => 'type_rooms',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'type-rooms',
                'updated_at' => '2023-01-19 17:56:45',
            ),
            5 => 
            array (
                'controller' => 'App\\Http\\Controllers\\CommandController',
                'created_at' => '2023-01-17 05:55:40',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'display_name_plural' => 'Registros',
                'display_name_singular' => 'Registro',
                'generate_permissions' => 1,
                'icon' => NULL,
                'id' => 6,
                'model_name' => 'App\\Models\\Command',
                'name' => 'commands',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'commands',
                'updated_at' => '2023-01-19 18:32:24',
            ),
        ));
        
        
    }
}