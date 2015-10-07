<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
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
 * @property integer $des_id
 * @property-read \App\Models\Destination $destination
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

    protected $fillable = ['user_id'];
    protected $hidden = ['photo_hash','photo_extensions'];

    protected static function boot(){
        parent::boot();

        static::creating(function($photo){
            $upload_to_s3 = false;
            // Set default value for 'like' field
            $photo->photo_like = 0;

            // Upload photo to S3
            $s3=Storage::disk('s3');
            $local=Storage::disk('local');
            // Get original local filename
            $filename=$photo['photo_hash'].'.'.$photo['photo_extensions'];
            if($upload_to_s3){
                // Build S3 file path
                $s3path='/photos/'.$filename;
                // Upload local file to S3
                $s3->put($s3path,static::resize_photo($local->get('/imgtemp/'.$filename)),'public');
                // Update url of file
                $photo['photo_awss3_url']=static::s3_path($s3path);
                // Delete local version
                $local->delete('/imgtemp/'.$filename);
            } else {
                //$urlroot = App::make('url')->asset('/api/r/images/'.$filename);
                $urlroot=App::make('url')->to('/');
                $urlroot=str_replace($urlroot,'',App::make('url')->current());
                $photo['photo_awss3_url'] = $urlroot.'/api/r/images/'.$filename;
            }
        });

        static::deleting(function($photo){
            $s3=Storage::disk('s3');
            $filename=$photo['photo_hash'].'.'.$photo['photo_extensions'];
            $s3path='/photos/'.$filename;
            $s3->delete($s3path);

            return parent::delete();
        });
    }

    public function destination(){
        return $this->belongsTo('App\Models\Destination');
    }

    private static function s3_path($path)
    {
        return 'http://s3-'.getenv('S3_REGION').'.amazonaws.com/'.getenv('S3_BUCKET').$path;
    }
    private static function resize_photo($stream)
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
        /** @var mixed $resized */
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
