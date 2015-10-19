<?php

namespace App\Models;

use ErrorException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Mockery\CountValidator\Exception;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Routing\UrlGenerator;

/**
 * App\Models\Photo
 *
 * @property integer $photo_id
 * @property integer $photo_like
 * @property integer $user_id
 * @property string $photo_uptime
 * @property string $photo_hash
 * @property string $photo_extensions
 * @property string $photo_awss3_url
 * @property string $internal_url
 * @property integer $des_id
 * @property-read \App\Models\Destination $destination
 * @property string src
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Photo wherePhotoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Photo wherePhotoLike($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Photo whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Photo wherePhotoUptime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Photo wherePhotoHash($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Photo wherePhotoExtensions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Photo wherePhotoAwss3Url($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Photo whereDesId($value)
 */
class Photo extends Model
{
    protected $table='Photo';
    protected $primaryKey = 'photo_id';
    public $timestamps = false;
    protected $appends = [ 'src' ];

    protected $fillable = [
        'user_id',
        'des_id',
        'photo_uptime',
        'photo_hash',
        'photo_extensions',
        'photo_like',
        'internal_url'];
    protected $hidden = ['internal_url'];

    protected static function boot(){
        parent::boot();
        static::creating(function($photo){
            $internalUrl=$photo['internal_url'];
            $uploadtime = time(); $photo['photo_uptime']=$uploadtime;
            $img_ext=pathinfo($internalUrl,PATHINFO_EXTENSION); $photo['photo_extensions']=$img_ext;
            $hash=uniqid($uploadtime,true); $photo['photo_hash']=$hash;
            $local_imgname=$hash.(strlen($img_ext)==0?'':'.'.$img_ext);

            // detect filename is local file or http
            try {
                Storage::put(
                    '/imgtemp/' . $local_imgname,
                    Photo::downloadPhoto($internalUrl)
                );

                $filename = $photo['photo_hash'] . '.' . $photo['photo_extensions'];
                $photo['photo_awss3_url'] = url('/api/r/image/' . $filename);
                $photo['internal_url'] = '';
            } catch (ErrorException $e){
                $console=new ConsoleOutput();
                $console->writeln([
                    'DOWNLOAD IMAGE ERROR:',
                    $e->getMessage()
                ]);
                $photo['photo_awss3_url'] = '';
            }
        });
        static::deleting(function($photo){
            $filename=$photo['photo_hash'].'.'.$photo['photo_extensions'];
            $localPath='/imgtemp/'.$filename;
            Storage::delete($localPath);

            return parent::delete();
        });
    }

    public function destination(){
        return $this->belongsTo('App\Models\Destination');
    }

    /**
     * @return string
     */
    public function getSrcAttribute(){
        if(strlen($this->photo_awss3_url)>0) return url($this->photo_awss3_url);
        return $this->internal_url;
    }

    private static function downloadPhoto($url){
        $isUrl=(substr($url,0,4)==='http');
        $requireSsl=(substr($url,0,5)==='https');
        $additionalOptions=array(
            "http" => array(
                "method" => "GET",
                "timeout" => 5,
                "follow_location" => false,
            )
        );

        return Photo::resize_photo(file_get_contents($isUrl?$url:database_path('/seeds/csv/photo_samples/'.$url),false,stream_context_create($additionalOptions)));
    }

    /**
     * @param string $stream
     * @return string
     */
    public static function resize_photo($stream)
    {
        $imgstream = imagecreatefromstring($stream);
        list($w,$h) = getimagesizefromstring($stream);

        // default height = 800
        $newH = 600;
        $percent = $newH / $h;
        $newW = $w * $percent;

        if ($percent>=1) {
            // no need to compress image
            unset($imgstream);
            return $stream;
        }

        // load
        $thumb = imagecreatetruecolor($newW, $newH);
        // resize
        imagecopyresized($thumb, $imgstream, 0, 0, 0, 0, $newW, $newH, $w, $h);
        // save to new stream
        /** @var string $resized */
        $resized = NULL;
        ob_start();
        imagejpeg($thumb);
        $resized = ob_get_contents();
        ob_end_clean();

        unset($imgstream);
        unset($thumb);

        return $resized;
    }
}
