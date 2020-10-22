<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `categores` (`id`, `name`) VALUES
            (\'1\', \'新能源\'),
            (\'2\', \'小型轿车\'),
            (\'3\', \'中型轿车\'),
            (\'4\', \'大型轿车\'),
            (\'5\', \'SUV\'),
            (\'6\', \'商务型\'),
            (\'7\', \'敞篷 四座\'),
            (\'8\', \'敞篷  两座\')
        ');
    }
}
