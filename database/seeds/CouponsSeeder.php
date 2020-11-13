<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert(' INSERT INTO `coupons` (`id`, `cost`, `name`, `des`, `expired_day`, `is_use`, `give_type`, `album_id`, `is_alert`, `created_at`, `updated_at`) VALUES (\'5\', \'30.00\', \'萌新专享优惠券\', \'适用于租金满10000.00使用\', \'30\', \'1\', \'1\', \'60\', \'1\', \'2020-11-13 16:01:43\', \'2020-11-13 16:01:43\'); ');
    }
}
