<?php

use Illuminate\Database\Seeder;
use App\User;
use App\AppRoute;
use App\AppMenu;
use App\AppModul;
use App\Role;
use Illuminate\Support\Str;

class Setup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = collect(['Administrator', 'Editor', 'Author', 'Subscriber']);

        foreach ($roles as $key) {
            $role = Role::create([
                'name' => $key
            ]);
        }

        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'role_id' => 1,
            'username' => 'admin',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $dataRoutes = collect(['#', 'home.index']);
        $dataMenus = [
            ['route_name' => '#', 'menu_name' => 'Root', 'icon' => '', 'parent_id' => 1, 'order_id' => 0, 'is_show' => 0],
            ['route_name' => 'home.index', 'menu_name' => 'Home', 'icon' => 'fas fa-home', 'parent_id' => 1, 'order_id' => 0, 'is_show' => 1],
        ];

        $dataModuls = [
            ['route_name' => 'home.index', 'role_id' => 1, 'is_active' => 1],
            ['route_name' => 'home.index', 'role_id' => 2, 'is_active' => 1],
            ['route_name' => 'home.index', 'role_id' => 3, 'is_active' => 1],
        ];

        foreach ($dataRoutes as $key) {
            $routes = AppRoute::create([
                'name' => $key
            ]);
        }

        AppMenu::insert($dataMenus);
        AppModul::insert($dataModuls);

        \App\Category::create(['name' => 'Uncategorized', 'slug' => 'uncategorized']);

    }
}
