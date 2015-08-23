<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Ulibier;

class UlibierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Ulibier')->delete();
        Ulibier::create(array(
            'firstname'     => 'Phong',
            'lastname'      => 'Truong Hung',
            'sex'           => 'male',
            'birthday'      => new DateTime('1993-12-18'),
            'email'         => 'programmingd32@gmail.com',
            'phonenumber'   => '+841667578431',
            'username'      => 'hungphongbk',
            'password'      => Hash::make('Hungphong1812')
        ));
        Ulibier::create(array(
            'firstname'     => 'Trung',
            'lastname'      => 'Nguyen Phan Thanh',
            'sex'           => 'male',
            'birthday'      => new DateTime('1993-1-10'),
            'email'         => 'trung.nguyen.hcmc@gmail.com',
            'phonenumber'   => '+84969734705',
            'username'      => 'trungluom',
            'password'      => Hash::make('123456')
        ));
    }
}
