<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Output\ConsoleOutput;

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
            // Set default value for 'like' field
            $photo->photo_like = 0;

            // Upload photo to S3
            $s3=Storage::disk('s3');
            $local=Storage::disk('local');
            // Get original local filename
            $filename=$photo['photo_hash'].'.'.$photo['photo_extensions'];
            // Build S3 file path
            $s3path='/photos/'.$filename;
            // Upload local file to S3
            $s3->put($s3path,$local->get('/imgtemp/'.$filename),'public');
            // Update url of file
            $photo['photo_awss3_url']=static::s3_path($s3path);
            // Delete local version
            $local->delete('/imgtemp/'.$filename);
        });
        static::deleting(function($photo){
            $s3=Storage::disk('s3');
            $filename=$photo['photo_hash'].'.'.$photo['photo_extensions'];
            $s3path='/photos/'.$filename;
            $s3->delete($s3path);

            return parent::delete();
        });
    }

    private static function s3_path($path)
    {
        return 's3-'.getenv('S3_REGION').'.amazonaws.com/'.getenv('S3_BUCKET').$path;
    }
}
