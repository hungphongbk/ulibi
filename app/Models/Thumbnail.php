<?php
/**
 * Created by PhpStorm.
 * User: hungphongbk
 * Date: 10/24/15
 * Time: 4:34 PM
 */

namespace App\Models;
use URL;

/**
 * Class Thumbnail
 * @package App\Models
 * @property string $thumbnail
 */
trait Thumbnail
{
    /**
     * @return string
     */
    public function getThumbnailAttribute() {}

    /**
     * @return string
     */
    public function getThumbnail200Attribute() {
        return $this->thumbnail.$this->widthParam(200);
    }

    /**
     * @return string
     */
    public function getThumbnail400Attribute() {
        return $this->thumbnail.$this->widthParam(400);
    }

    /**
     * @return string
     */
    public function getThumbnail600Attribute() {
        return $this->thumbnail.$this->widthParam(600);
    }

    /**
     * @return string
     */
    public function getThumbnail800Attribute() {
        return $this->thumbnail.$this->widthParam(800);
    }

    /**
     * @return string
     */
    public function getThumbnail1000Attribute() {
        return $this->thumbnail.$this->widthParam(1000);
    }

    /**
     * @return string
     */
    public function getThumbnail1200Attribute() {
        return $this->thumbnail.$this->widthParam(1200);
    }

    /**
     * @return string
     */
    public function getThumbnailOriginAttribute() {
        return $this->thumbnail.$this->widthParam(1900);
    }

    /**
     * @param int $width
     * @return string
     */
    private function widthParam($width){
        // check host
        $host=parse_url($this->thumbnail)['host'];
        $current=parse_url(url('/'))['host'];
        if($host!==$current) return '';
        return '?w='.$width;
    }
}