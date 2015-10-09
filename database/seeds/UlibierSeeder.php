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
        DB::table('UlibierPermission')->delete();
        DB::table('Ulibier')->delete();

        \App\UlibierPermission::create(array(
            'permission_name' => 'admin'
        ));

        Ulibier::create(array(
            'permission_id' => 1,
            'firstname'     => 'Phong',
            'lastname'      => 'Trương Hùng',
            'sex'           => 'male',
            'birthday'      => new DateTime('1993-12-18'),
            'email'         => 'programmingd32@gmail.com',
            'phonenumber'   => '+841667578431',
            'username'      => 'hungphongbk',
            'password'      => Hash::make('Hungphong1812'),
            'avatar'        => 22
        ));
        Ulibier::create(array(
            'permission_id' => 1,
            'firstname'     => 'Trung',
            'lastname'      => 'Nguyễn Phan Thành',
            'sex'           => 'male',
            'birthday'      => new DateTime('1993-1-10'),
            'email'         => 'trung.nguyen.hcmc@gmail.com',
            'phonenumber'   => '+84969734705',
            'username'      => 'trungluom',
            'password'      => Hash::make('123456'),
            'avatar'        => 23
        ));
        Ulibier::create(array(
            'permission_id' => 1,
            'firstname'     => 'Châu',
            'lastname'      => 'Trần Ngọc Thuỳ',
            'sex'           => 'female',
            'birthday'      => new DateTime('1993-2-10'),
            'email'         => 'tranthithuychau1993@gmail.com',
            'phonenumber'   => '+84969734705',
            'username'      => 'tranchau',
            'password'      => Hash::make('123456'),
            'avatar'        => 24
        ));
    }
}
