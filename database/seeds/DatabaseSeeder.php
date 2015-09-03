<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(UlibierSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(Destinations::class);
        $this->call(PhotoSeeder::class);
        Model::reguard();
    }
}
