<?php

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use mnshankar\CSV\CSV;

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
        $csv=new CSV();
        $articles=$csv->fromFile(dirname(__FILE__).'/csv/Article.csv')->toArray();
        foreach ($articles as $a) {
            Article::create($a);
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
