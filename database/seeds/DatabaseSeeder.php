<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    public static $massSeed=false;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DatabaseSeeder::$massSeed=true;
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        $this->call(UlibierSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(Destinations::class);
        $this->call(PhotoSeeder::class);
        $this->call(ArticleDestinationMappingSeeder::class);
        $this->call(TagSeeder::class);

        Model::reguard();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        DatabaseSeeder::$massSeed=false;
    }
}
