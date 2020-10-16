<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UsersModel;

class GenerateToken extends Command
{
    protected $signature = 'larabbs:generate-token';

    protected $description = '快速为用户生成 token';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userId = $this->ask('输入用户 id');

        $user = UsersModel::find($userId);

        if (!$user) {
            return $this->error('用户不存在');
        }

        // 一年以后过期，单位分钟
        $ttl = 365*24*60;
        $this->info(auth('api')->setTTL($ttl)->login($user));
    }
}
