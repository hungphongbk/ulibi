<?php
/**
 * Created by PhpStorm.
 * User: hungphongbk
 * Date: 10/20/15
 * Time: 1:30 PM
 */

namespace App\Http\Controllers;


trait ConsoleHelper
{
    /**
     * @param string $text
     * @return void
     */
    private function consolePrintInfo($text){
        $this->getCommand()->writeln("<info>$text</info>");
    }
    /**
     * @return \Symfony\Component\Console\Output\ConsoleOutput
     */
    private function getCommand(){
        return (isset($this->command)?$this->command:new \Symfony\Component\Console\Output\ConsoleOutput());
    }
}