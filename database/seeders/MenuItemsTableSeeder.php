<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu_items')->delete();
        
        \DB::table('menu_items')->insert(array (
            0 => 
            array (
                'color' => NULL,
                'created_at' => '2023-01-17 00:51:19',
                'icon_class' => 'voyager-boat',
                'id' => 1,
                'menu_id' => 1,
                'order' => 1,
                'parameters' => NULL,
                'parent_id' => NULL,
                'route' => 'voyager.dashboard',
                'target' => '_self',
                'title' => 'Tablero',
                'updated_at' => '2023-01-17 00:56:20',
                'url' => '',
            ),
            1 => 
            array (
                'color' => NULL,
                'created_at' => '2023-01-17 00:51:20',
                'icon_class' => 'voyager-person',
                'id' => 3,
                'menu_id' => 1,
                'order' => 5,
                'parameters' => NULL,
                'parent_id' => NULL,
                'route' => 'voyager.users.index',
                'target' => '_self',
                'title' => 'Usuarios',
                'updated_at' => '2023-01-29 07:51:15',
                'url' => '',
            ),
            2 => 
            array (
                'color' => NULL,
                'created_at' => '2023-01-17 00:51:20',
                'icon_class' => 'voyager-lock',
                'id' => 4,
                'menu_id' => 1,
                'order' => 6,
                'parameters' => NULL,
                'parent_id' => NULL,
                'route' => 'voyager.roles.index',
                'target' => '_self',
                'title' => 'Roles',
                'updated_at' => '2023-01-29 07:51:15',
                'url' => '',
            ),
            3 => 
            array (
                'color' => NULL,
                'created_at' => '2023-01-17 00:51:20',
                'icon_class' => 'voyager-tools',
                'id' => 5,
                'menu_id' => 1,
                'order' => 8,
                'parameters' => NULL,
                'parent_id' => NULL,
                'route' => NULL,
                'target' => '_self',
                'title' => 'Herramientas',
                'updated_at' => '2023-01-29 07:50:33',
                'url' => '',
            ),
            4 => 
            array (
                'color' => NULL,
                'created_at' => '2023-01-17 00:51:20',
                'icon_class' => 'voyager-list',
                'id' => 6,
                'menu_id' => 1,
                'order' => 1,
                'parameters' => NULL,
                'parent_id' => 5,
                'route' => 'voyager.menus.index',
                'target' => '_self',
                'title' => 'Diseñador de Menús',
                'updated_at' => '2023-01-17 00:56:02',
                'url' => '',
            ),
            5 => 
            array (
                'color' => NULL,
                'created_at' => '2023-01-17 00:51:20',
                'icon_class' => 'voyager-data',
                'id' => 7,
                'menu_id' => 1,
                'order' => 2,
                'parameters' => NULL,
                'parent_id' => 5,
                'route' => 'voyager.database.index',
                'target' => '_self',
                'title' => 'Base de Datos',
                'updated_at' => '2023-01-17 00:56:02',
                'url' => '',
            ),
            6 => 
            array (
                'color' => NULL,
                'created_at' => '2023-01-17 00:51:20',
                'icon_class' => 'voyager-compass',
                'id' => 8,
                'menu_id' => 1,
                'order' => 3,
                'parameters' => NULL,
                'parent_id' => 5,
                'route' => 'voyager.compass.index',
                'target' => '_self',
                'title' => 'Compás',
                'updated_at' => '2023-01-17 00:56:02',
                'url' => '',
            ),
            7 => 
            array (
                'color' => NULL,
                'created_at' => '2023-01-17 00:51:20',
                'icon_class' => 'voyager-bread',
                'id' => 9,
                'menu_id' => 1,
                'order' => 4,
                'parameters' => NULL,
                'parent_id' => 5,
                'route' => 'voyager.bread.index',
                'target' => '_self',
                'title' => 'BREAD',
                'updated_at' => '2023-01-17 00:56:02',
                'url' => '',
            ),
            8 => 
            array (
                'color' => '#000000',
                'created_at' => '2023-01-17 00:51:20',
                'icon_class' => 'voyager-settings',
                'id' => 10,
                'menu_id' => 1,
                'order' => 7,
                'parameters' => 'null',
                'parent_id' => NULL,
                'route' => 'voyager.settings.index',
                'target' => '_self',
                'title' => 'Configuración',
                'updated_at' => '2023-01-29 07:51:05',
                'url' => '',
            ),
            9 => 
            array (
                'color' => '#000000',
                'created_at' => '2023-01-17 01:21:25',
                'icon_class' => 'voyager-shop',
                'id' => 11,
                'menu_id' => 1,
                'order' => 3,
                'parameters' => 'null',
                'parent_id' => NULL,
                'route' => 'voyager.rooms.index',
                'target' => '_self',
                'title' => 'Habitaciones',
                'updated_at' => '2023-01-29 07:51:13',
                'url' => '',
            ),
            10 => 
            array (
                'color' => '#000000',
                'created_at' => '2023-01-20 00:54:04',
                'icon_class' => 'voyager-rum',
                'id' => 12,
                'menu_id' => 1,
                'order' => 2,
                'parameters' => NULL,
                'parent_id' => NULL,
                'route' => 'voyager.commands.index',
                'target' => '_self',
                'title' => 'Comandas',
                'updated_at' => '2023-01-29 07:51:10',
                'url' => '',
            ),
            11 => 
            array (
                'color' => '#000000',
                'created_at' => '2023-01-20 00:54:42',
                'icon_class' => 'voyager-dollar',
                'id' => 13,
                'menu_id' => 1,
                'order' => 4,
                'parameters' => NULL,
                'parent_id' => NULL,
                'route' => 'voyager.type-rooms.index',
                'target' => '_self',
                'title' => 'Tipo de habitación',
                'updated_at' => '2023-01-29 07:51:15',
                'url' => '',
            ),
        ));
        
        
    }
}