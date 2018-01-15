<?php

use Illuminate\Database\Seeder;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 5)->create();
        $ips = factory(App\Ip::class, 5)->make()->each(function ($ip) use ($users) {
            $ip->user_id = $users[mt_rand(0, count($users) - 1)]->id;
            $ip->save();
        });
        $jails = factory(App\Jail::class, 5)->make()->each(function ($jail ,$i) use ($ips, $users) {
            $jail->user_id = $users[mt_rand(0, count($users) - 1)]->id;
            $jail->ip_id = $ips[$i]->id;
            $jail->save();
        });
    }
}
