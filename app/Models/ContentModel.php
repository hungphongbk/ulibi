<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentModel extends Model
{
    protected $contentField;

    /**
     * @return string
     */
    public function getContentAsPlainTextAttribute(){
        return $this->parseContentIntoText();
    }

    /**
     * @return string
     */
    public function getContentAsHtmlAttribute(){
        return $this->parseContentIntoHtml();
    }

    /**
     * @return string
     */
    private function parseContentIntoHtml(){
        $text=$this[$this->contentField];
        $jade_bin="/usr/local/bin/jade";

        $command="echo \"$text\" | $jade_bin";
        $output=shell_exec($command);

        return $output;
    }

    /**
     * @return string
     */
    private function parseContentIntoText(){
        return "This is a plain text";
    }
}
