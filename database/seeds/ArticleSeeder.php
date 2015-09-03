<?php

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Article')->delete();
        if (($handle = fopen(dirname(__FILE__).'/csv/Article.csv','r')) !== FALSE){
            $fields = fgetcsv($handle);
            while (($line = fgetcsv($handle, 1000, ',')) !== FALSE){
                Article::create($this->zipArray($fields, $line));
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
