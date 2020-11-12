<?php

use Illuminate\Database\Seeder;

class ConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `configs` VALUES (\'1\', \'AMAP_KEY\', \'b9ec8422cefaed1483796733ed761921\', null, null, null);');
        DB::insert('INSERT INTO `configs` VALUES (\'2\', \'BACK_LOGO\', \'14\', null, null, \'2020-11-05 13:54:15\');');
        DB::insert('INSERT INTO `configs` VALUES (\'3\', \'APP_NAME\', \'鑫旺达租车go\', null, null, \'2020-11-05 13:54:15\');');
        DB::insert('INSERT INTO `configs` VALUES (\'4\', \'MINI_PROGRAM_APP_ID\', \'wxb0e720433455d030\', \'小程序应用ID\', null, \'2020-11-11 21:17:35\');');
        DB::insert('INSERT INTO `configs` VALUES (\'5\', \'MINI_PROGRAM_APP_SECRET\', \'dd4b61331704ecf4d4aa1ea6d5d68882\', \'小程序密钥\', null, \'2020-11-11 21:17:35\');');
        DB::insert('INSERT INTO `configs` (`id`, `name`, `value`, `note`, `created_at`, `updated_at`) VALUES (\'6\', \'APP_LOGO\', \'48\', NULL, NULL, NULL);');
    }
}
