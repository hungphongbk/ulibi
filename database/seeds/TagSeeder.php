<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    protected $model='\\App\\Models\\Tag';
    use SeederHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->beforeRun();
        DB::table('Tag')->truncate();
        $csv=new \mnshankar\CSV\CSV();
        $tags=$csv->fromFile(dirname(__FILE__).'/csv/Tag.csv')->toArray();
        foreach ($tags as $t) {
            \App\Models\Tag::create($t);
        }

        $this->afterRun();
    }
}
