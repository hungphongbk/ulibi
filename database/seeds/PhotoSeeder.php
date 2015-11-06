<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Output\ConsoleOutput;
use App\Models\Photo;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Photo')->truncate();
        if (($handle = fopen(dirname(__FILE__).'/csv/Photo.csv','r')) !== FALSE){
            fgetcsv($handle);
            while (($line = fgetcsv($handle, 1000, ',')) !== FALSE){
                $content=\App\Models\ContentBase::create([ "content_type" => 1 ]);
                $content->photo()->create(array(
                    'username'       => $line[0],
                    'des_id'        => $line[1],
                    'photo_like'    => $line[2],
                    'internal_url'  => $line[3],
                ));

            }
        }
    }
}
