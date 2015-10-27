<?php

use Illuminate\Database\Seeder;
use App\Ulibier;
use mnshankar\CSV\CSV;

class UlibierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('UlibierPermission')->delete();
        DB::table('Ulibier')->delete();
        DB::table('UlibierProfile')->delete();

        \App\UlibierPermission::create(array(
            'permission_name' => 'admin'
        ));
        \App\UlibierPermission::create(array(
            'permission_name' => 'user'
        ));

        $csv=new CSV();
        $ulibiers=$csv->fromFile(dirname(__FILE__).'/csv/Ulibier.csv')->toArray();
        $profiles=$csv->fromFile(dirname(__FILE__).'/csv/UlibierProfile.csv')->toArray();
        for ($i=0; $i<count($ulibiers); $i++) {
            $k=$ulibiers[$i]; $v=$profiles[$i];
            $ulibier=new Ulibier();
            $ulibier->fill($k)
                ->setAttribute('password',bcrypt($k['password']))
                ->save();

            $ulibier->profile()->create($v);
        }

    }
}
