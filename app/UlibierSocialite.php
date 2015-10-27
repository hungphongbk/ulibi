<?php
/**
 * Created by PhpStorm.
 * User: hungphongbk
 * Date: 10/15/15
 * Time: 12:34 PM
 */

namespace App;


use Mockery\CountValidator\Exception;

trait UlibierSocialite
{
    /**
     * @return array
     */
    public function facebookRequiredScopes(){
        return array('first_name', 'last_name', 'email', 'gender', 'birthday', 'link', 'verified');
    }

    /**
     * @param string $provider
     * @param \Laravel\Socialite\AbstractUser $object
     * @param string $field
     * @return string
     */
    protected function getSocialField($provider,$object,$field){
        $method='getSocialField_'.$field;
        if(method_exists($this,$method)){
            return $this->$method($provider,$object);
        }
        return '';
    }

    /**
     * @param string $provider
     * @param $object
     * @return string
     */
    private function getSocialField_firstName($provider,$object){
        switch($provider){
            case 'facebook': return $object->user['first_name'];
            default: return '';
        }
    }

    /**
     * @param string $provider
     * @param $object
     * @return string
     */
    private function getSocialField_lastName($provider,$object){
        switch($provider){
            case 'facebook': return $object->user['last_name'];
            default: return '';
        }
    }

    /**
     * @param string $provider
     * @param $object
     * @return string
     */
    private function getSocialField_gender($provider,$object){
        switch($provider){
            case 'facebook': return $object->user['gender'];
            default: return '';
        }
    }

    /**
     * @param string $provider
     * @param $object
     * @return string
     */
    private function getSocialField_birthday($provider,$object){
        try {
            switch ($provider) {
                case 'facebook':
                    return $object->user['birthday'];
                default: return '01/01/1990';
            }
        } catch (\ErrorException $e){
            return '01/01/1990';
        }
    }

    /**
     * @param string $provider
     * @param $object
     * @return string
     */
    private function getSocialField_email($provider,$object){
        switch($provider){
            case 'facebook': return $object->user['email'];
            default: return '';
        }
    }

    /**
     * @param string $provider
     * @param $object
     * @return string
     */
    private function getSocialField_avatar($provider,$object){
        switch($provider){
            case 'facebook': return $object->avatar_original;
            default: return '';
        }
    }
}