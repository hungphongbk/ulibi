<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Destinations extends Seeder
{
    protected $model='\\App\\Models\\Destination';
    use SeederHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->beforeRun();
        DB::table('Destination')->delete();
        if (($handle = fopen(dirname(__FILE__).'/csv/Destination.csv','r')) !== FALSE){
            fgetcsv($handle);
            while (($line = fgetcsv($handle, 2000, ',')) !== FALSE && count($line)>3){
                DB::statement("INSERT INTO Destination(des_name,des_instruction,coordinate) VALUES ('$line[0]', '$line[1]', GeomFromText('POINT(".$line[2]." ".$line[3].")'))");
            }
        }
        $this->afterRun();
    }
}
