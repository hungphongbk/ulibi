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
        DB::table('Photo')->delete();
        $local=Storage::disk('local');
        if (($handle = fopen(dirname(__FILE__).'/csv/Photo.csv','r')) !== FALSE){
            fgetcsv($handle);
            while (($line = fgetcsv($handle, 1000, ',')) !== FALSE){
                $uploadtime = time();
                // $line[3] is file name
                // copy file to local storage
                $img_ext=pathinfo($line[3],PATHINFO_EXTENSION);
                $hash=uniqid($uploadtime,true);
                $local_imgname=$hash.'.'.$img_ext;
                $local->put('/imgtemp/'.$local_imgname,file_get_contents(dirname(__FILE__).'/csv/photo_samples/'.$line[3]));

                Photo::create(array(
                    'user_id'       => $line[0],
                    'des_id'        => $line[1],
                    'photo_like'    => $line[2],
                    'photo_hash'    => $hash,
                    'photo_uptime'  => $uploadtime,
                    'photo_extensions'  => $img_ext
                ));
            }
        }
    }
}
