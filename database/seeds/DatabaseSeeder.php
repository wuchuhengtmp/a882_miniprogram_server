<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AlbumsSeeder::class);
        $this->call(BrandsSeeder::class);
        $this->call(CategoresSeeder::class);

        $this->call(ConfigsSeeder::class);
        $this->call(FqSeeder::class);
        $this->call(GoodsSeeder::class);
        $this->call(GoodsTagSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(PayNoticesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(RegionsSeeder::class);
        $this->call(RolePermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(SlidesSeeder::class);
        $this->call(UserBannersSeeder::class);
        $this->call(UserRolesSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
