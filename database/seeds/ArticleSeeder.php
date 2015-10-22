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
}
