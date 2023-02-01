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
                'id' => 1,
                'name' => 'users',
                'slug' => 'users',
                'display_name_singular' => 'User',
                'display_name_plural' => 'Users',
                'icon' => 'voyager-person',
                'model_name' => 'App\\Models\\User',
                'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":"users"}',
                'created_at' => '2022-11-09 19:18:29',
                'updated_at' => '2023-01-20 01:15:41',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'menus',
                'slug' => 'menus',
                'display_name_singular' => 'Menu',
                'display_name_plural' => 'Menus',
                'icon' => 'voyager-list',
                'model_name' => 'TCG\\Voyager\\Models\\Menu',
                'policy_name' => NULL,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2022-11-09 19:18:29',
                'updated_at' => '2022-11-09 19:18:29',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'roles',
                'slug' => 'roles',
                'display_name_singular' => 'Role',
                'display_name_plural' => 'Roles',
                'icon' => 'voyager-lock',
                'model_name' => 'App\\Models\\Role',
                'policy_name' => NULL,
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":"roles"}',
                'created_at' => '2022-11-09 19:18:29',
                'updated_at' => '2022-11-09 20:02:45',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'rooms',
                'slug' => 'rooms',
                'display_name_singular' => 'Habitación',
                'display_name_plural' => 'Habitaciones',
                'icon' => 'voyager-home',
                'model_name' => 'App\\Models\\Room',
                'policy_name' => NULL,
                'controller' => 'App\\Http\\Controllers\\RoomController',
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2023-01-17 06:25:58',
                'updated_at' => '2023-01-19 23:56:29',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'type_rooms',
                'slug' => 'type-rooms',
                'display_name_singular' => 'Tipo de habitación',
                'display_name_plural' => 'Tipo de habitaciones',
                'icon' => 'voyager-double-right',
                'model_name' => 'App\\Models\\TypeRoom',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2023-01-17 06:27:55',
                'updated_at' => '2023-01-19 23:56:45',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'commands',
                'slug' => 'commands',
                'display_name_singular' => 'Registro',
                'display_name_plural' => 'Registros',
                'icon' => NULL,
                'model_name' => 'App\\Models\\Command',
                'policy_name' => NULL,
                'controller' => 'App\\Http\\Controllers\\CommandController',
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":"commands"}',
                'created_at' => '2023-01-17 11:55:40',
                'updated_at' => '2023-02-01 05:59:03',
            ),
        ));
        
        
    }
}