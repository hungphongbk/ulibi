<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // Create ulibier permissions table
        Schema::create('UlibierPermission', function(Blueprint $table){
            $table->increments('permission_id');
            $table->string('permission_name')->unique();
            $table->timestamps();
        });
        // Create ulibier table
        Schema::create('Ulibier', function (Blueprint $table) {
            $table->increments('user_id');
            $table->integer('permission_id')->unsigned();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('sex');
            $table->date('birthday');
            $table->string('email');
            $table->string('phonenumber');
            $table->string('nationality');
            $table->string('username')->unique();
            $table->boolean('registered_with_social_account')->default(false);
            $table->string('password');
            $table->string('blog_url');
            // $table->integer('avatar_id'); - modify at next migration
            $table->string('report');
            $table->timestamps();
            $table->string('remember_token', 100);

            $table->foreign('permission_id')
                ->references('permission_id')
                ->on('UlibierPermission')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // Create article table
        Schema::create('Article', function (Blueprint $table) {
            $table->increments('article_id');
            $table->integer('user_id')->unsigned();
            $table->integer('article_like')->unsigned();
            $table->string('article_title');
            $table->text('article_content');
            $table->string('article_content_type')->default('jade');
            $table->datetime('article_date');
            $table->integer('view')->unsigned();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('Ulibier')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // Create comment table
        Schema::create('Comment', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->dateTime('comment_time');
            $table->string('comment_content');
            $table->integer('user_id')->unsigned();     // Comment's author
            $table->integer('article_id')->unsigned();  // Article id which this comment belongs to

            $table->foreign('user_id')
                ->references('user_id')
                ->on('Ulibier')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('article_id')
                ->references('article_id')
                ->on('Article')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // Create blog table
        Schema::create('Blog', function (Blueprint $table) {
            $table->string('blog_url')->unique();
            $table->float('blog_rate');
            $table->integer('blog_layout_type');
            // [VN] Vì một bài viết có thể liên kết đến nhiều article và ngược lại
            // [VN] Tách thành một bảng riêng "map" blog và article
            // [VN] Tương tự với ảnh
            $table->integer('blog_background')->unsigned();
            $table->integer('blog_view')->unsigned();

            $table->primary('blog_url');
        });

        // Create photo table
        Schema::create('Photo', function (Blueprint $table) {
            $table->increments('photo_id');
            $table->integer('photo_like')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->dateTime('photo_uptime');
            $table->string('photo_hash');
            $table->string('photo_extensions');
            $table->string('photo_awss3_url');
            $table->text('internal_url');
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('Ulibier')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        // Update Ulibier table - allow avatar
        Schema::table('Ulibier', function($table){
            $table->integer('avatar')->unsigned()->nullable();
            $table->foreign('avatar')
                ->references('photo_id')
                ->on('Photo')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        // Update Article table - add cover photo
        Schema::table('Article', function(Blueprint $table){
            $table->integer('cover_id')
                ->unsigned()
                ->nullable()
                ->after('article_title');
            $table->foreign('cover_id')
                ->references('photo_id')
                ->on('Photo')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // Create table will map Blog And Photo
        Schema::create('BlogPhotoMapping', function (Blueprint $table){
            $table->string('blog_url')->unique();
            $table->integer('photo_id')->unsigned();

            $table->primary(array('blog_url','photo_id'));
            $table->foreign('blog_url')
                ->references('blog_url')
                ->on('Blog')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('photo_id')
                ->references('photo_id')
                ->on('Photo')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        // Create table will map Article and Photo
        Schema::create('ArticlePhotoMapping', function (Blueprint $table){
            $table->integer('article_id')->unsigned();
            $table->integer('photo_id')->unsigned();

            $table->primary(array('article_id','photo_id'));
            $table->foreign('article_id')
                ->references('article_id')
                ->on('Article')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('photo_id')
                ->references('photo_id')
                ->on('Photo')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // Create destination table
        Schema::create('Destination', function(Blueprint $table) {
            $table->increments('des_id');
            $table->string('des_name');
            $table->text('des_instruction');
            $table->integer('prop_id')->unsigned();
        });
        DB::statement('ALTER TABLE Destination ADD coordinate GEOMETRY' );
        Schema::table('Photo', function($table){
            $table->integer('des_id')->unsigned()->nullable();
            $table->foreign('des_id')
                ->references('des_id')
                ->on('Destination')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // Create table will map Article and Destination
        Schema::create('ArticleDestinationMapping', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->integer('des_id')
                ->unsigned();

            $table->unique(array('article_id','des_id'));
            $table->foreign('article_id')
                ->references('article_id')
                ->on('Article')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('des_id')
                ->references('des_id')
                ->on('Destination')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        // Create user's rate information table
        Schema::create('Rate', function (Blueprint $table) {
            $table->integer('des_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('budget')->unsigned();
            $table->integer('visit_time')->unsigned();
            $table->string('vehicle');

            $table->primary(array('des_id','user_id'));
            $table->foreign('des_id')
                ->references('des_id')
                ->on('Destination')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('user_id')
                ->references('user_id')
                ->on('Ulibier')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::create('Tag', function (Blueprint $table) {
            $table->increments('tag_id');
            $table->string('tag_name');
        });

        Schema::create('ArticleTag', function (Blueprint $table) {
            $table->integer('article_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->primary(array('article_id', 'tag_id'));
            $table->foreign('article_id')
                ->references('article_id')
                ->on('Article')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('tag_id')
                ->references('tag_id')->on('Tag')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //First, delete folder 'photo' in S3 bucket
        $local = Storage::disk('local');
        $local->deleteDirectory('/imgtemp');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $tables=['UlibierPermission','Ulibier','Article','ArticlePhotoMapping','ArticleDestinationMapping','Comment','Blog','BlogPhotoMapping', 'Photo','Destination','Rate','Tag','ArticleTag'];
        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}