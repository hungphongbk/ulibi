<?php

use Illuminate\Database\Seeder;
use App\Models\Mapping\ArticleDestination;

class ArticleDestinationMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ArticleDestinationMapping')->delete();
        if (($handle = fopen(dirname(__FILE__).'/csv/ArticleDestinationMapping.csv','r')) !== FALSE){
            $fields = fgetcsv($handle);
            while (($line = fgetcsv($handle, 1000, ',')) !== FALSE){
                ArticleDestination::create($this->zipArray($fields, $line));
            }
        }
    }

    /**
     * @param array $arr1
     * @param array $arr2
     * @return array
     */
    protected function zipArray($arr1,$arr2){
        $result=array();
        $count=count($arr1);
        for($i=0;$i<$count;$i++)
            $result[$arr1[$i]]=$arr2[$i];
        return $result;
    }
}
