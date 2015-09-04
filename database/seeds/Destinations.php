<?php

use Illuminate\Database\Seeder;

class Destinations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Destination')->delete();
        if (($handle = fopen(dirname(__FILE__).'/csv/Destination.csv','r')) !== FALSE){
            fgetcsv($handle);
            while (($line = fgetcsv($handle, 1000, ',')) !== FALSE){
                DB::statement("INSERT INTO Destination(des_name,des_instruction,coordinate) VALUES ('$line[0]', '$line[1]', GeomFromText('POINT(".$line[2]." ".$line[3].")'))");
            }
        }
    }
}