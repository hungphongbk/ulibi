<?php
/**
 * Created by PhpStorm.
 * User: hungphongbk
 * Date: 10/19/15
 * Time: 1:49 PM
 */

trait SeederHelper
{
    protected function beforeRun(){
        if(!DatabaseSeeder::$massSeed) {
            call_user_func(array($this->getModelName(), 'unguard'));
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }
    }

    protected function afterRun(){
        if(!DatabaseSeeder::$massSeed) {
            call_user_func(array($this->getModelName(), 'reguard'));
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }
    }

    protected function getModelName(){
        return (isset($this->model)?$this->model:'');
    }
}