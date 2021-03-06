<?php

namespace App\Models;

use App\Models\Helper\CommentList;
use ErrorException;
use finfo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Model;
use Storage;
use Symfony\Component\Console\Output\ConsoleOutput;
use Flysystem;


/**
 * App\Models\Photo
 *
 * @property integer $photo_id
 * @property integer $photo_like
 * @property string $username
 * @property string $photo_uptime
 * @property string $photo_hash
 * @property string $photo_extensions
 * @property string $photo_awss3_url
 * @property string $internal_url
 * @property integer $des_id
 * @property-read \App\Ulibier $owner
 * @property-read \App\Models\Destination $destination
 * @property-read \App\Models\ContentBase $content
 * @property-read \App\Models\Comment[] $comments
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
    protected $dates = ['deleted_at'];
    protected $fillable = ['*'];
    use SoftDeletes, CommentList;

    /**
     *
     */
    protected static function boot(){
        parent::boot();
        static::creating(function($photo){
            /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
            $disk=Storage::disk();

            if($photo['username']==null){
                $photo['username']=\Auth::user()->username;
            }

            $internalUrl=$photo['internal_url'];
            $uploadtime = time();
            $hash=uniqid($uploadtime,true); $photo['photo_hash']=$hash;

            $img_ext='';
            try {

                $stream=Photo::downloadPhoto($internalUrl,$img_ext);
                $local_imgname=$hash.(strlen($img_ext)==0?'':'.'.$img_ext);

                $disk->put( '/imgtemp/' . $local_imgname, $stream );

                $filename = $photo['photo_hash'] . '.' . $img_ext;
                $photo['photo_awss3_url'] = '/api/r/image/' . $filename;
                $photo['internal_url'] = '';
            } catch (ErrorException $e){
                $console=new ConsoleOutput();
                $console->writeln([
                    '<info>DOWNLOAD IMAGE ERROR :</info>',
                    $e->getMessage()
                ]);
                $photo['photo_awss3_url'] = '';
            } finally {
                $photo['photo_extensions']=$img_ext;
            }
        });
        static::deleting(function($photo){
            /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
            $disk=Storage::disk();

            $filename=$photo['photo_hash'].'.'.$photo['photo_extensions'];
            $localPath='/imgtemp/'.$filename;
            $disk->delete($localPath);

            return parent::delete();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(){
        return $this->belongsTo('App\Ulibier', 'username', 'username');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content(){
        return $this->belongsTo('App\Models\ContentBase', 'photo_id', 'content_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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

    /**
     * @param $url
     * @param $mimeType
     * @return string
     * @throws ErrorException
     */
    private static function downloadPhoto($url,&$mimeType){
        $isUrl=(substr($url,0,4)==='http');
        $isDataURI=(substr($url,0,5)==='data:');
        $additionalOptions=array(
            "http" => array(
                "method" => "GET",
                "timeout" => 5,
                "follow_location" => false,
            )
        );
        //
        /** @var string $stream */
        $stream='';
        if($isDataURI) {
            preg_match("/data:image\/(.+?);base64,(.+)/", $url, $match);
            $mimeType=$match[1];
            $stream=base64_decode(str_replace(' ','+',$match[2]));
            $console=new ConsoleOutput();
            $console->writeln([
                "<info>MIME image detected (type=$mimeType) </info>"
            ]);
        } else if($isUrl) {
            $stream=file_get_contents($url,false,stream_context_create($additionalOptions));
            $file_info = new finfo(FILEINFO_MIME_TYPE);
            $mime=$file_info->buffer($stream);
            $mimeType=substr($mime,strpos($mime,'/')+1);
        } else {
            $stream=file_get_contents(database_path('/seeds/csv/photo_samples/'.$url));
            $mimeType=pathinfo($url,PATHINFO_EXTENSION);
        }

        // return Photo::resize_photo($stream);
        // no need to resize photo when upload
        if (empty($stream))
            throw new \ErrorException();
        return $stream;
    }

    /**
     * @param string $stream
     * @param int $maxWidth
     * @return string
     */
    public static function resize_photo($stream, $maxWidth = 600)
    {
        $imgstream = imagecreatefromstring($stream);
        list($w,$h) = getimagesizefromstring($stream);

        $newW = $maxWidth;
        $percent = $newW / $w;
        $newH = $h * $percent;

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

    /**
     * Get sample Image Url when suitable photo does not exist
     * @return string
     */
    public static function samplePhotoUrl(){
        return url('/img/img-1.jpg');
    }
}
