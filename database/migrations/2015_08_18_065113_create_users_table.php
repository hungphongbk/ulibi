<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
        Schema::create('UlibierPermission', function (Blueprint $table) {
            $table->increments('permission_id');
            $table->string('permission_name')->unique();
            $table->timestamps();
        });
        // Create ulibier table
        Schema::create('Ulibier', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->integer('permission_id')->unsigned();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
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
        Schema::create('UlibierProfile', function (Blueprint $table) {
            $table->string('username');
            $table->string('sex');
            $table->date('birthday');
            $table->string('phonenumber');
            $table->string('nationality');

            $table->text('aboutme_description');
            $table->text('aboutme_quotes');
            $table->string('basicinfo_currentPlace');
            $table->string('basicinfo_job');
            $table->string('basicinfo_hobbies');

            $table->primary('username');
            $table->foreign('username')
                ->references('username')
                ->on('Ulibier')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::create('ContentBase', function (Blueprint $table) {
            $table->increments('content_id');
            $table->smallInteger('content_type');
            /*
             * type = 0: article
             * type = 1: photo
             * type = 2: comment
             * */
            $table->timestamps();
        });

        // Create article table
        Schema::create('Article', function (Blueprint $table) {
            $table->integer('article_id')->unsigned();
            $table->string('username');
            $table->integer('article_like')->unsigned();
            $table->string('article_title');
            $table->text('article_content');
            $table->string('article_content_type')->default('jade');
            $table->datetime('article_date');
            $table->integer('view')->unsigned();
            $table->softDeletes();

            $table->primary('article_id');
            $table->foreign('article_id')
                ->references('content_id')
                ->on('ContentBase')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('username')
                ->references('username')
                ->on('Ulibier')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // Create comment table
        Schema::create('Comment', function (Blueprint $table) {
            $table->integer('comment_id')->unsigned();
            $table->string('comment_content');
            $table->string('username');     // Comment's author
            $table->integer('content_id')->unsigned();  // Content id which this comment belongs to
            $table->timestamps();

            $table->primary('comment_id');
            $table->foreign('username')
                ->references('username')
                ->on('Ulibier')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('comment_id')
                ->references('content_id')
                ->on('ContentBase')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('content_id')
                ->references('content_id')
                ->on('ContentBase')
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
            $table->integer('photo_id')->unsigned();
            $table->string('photo_description')->default('');
            $table->integer('photo_like')->unsigned();
            $table->string('username');
            $table->string('photo_hash');
            $table->string('photo_extensions');
            $table->string('photo_awss3_url');
            $table->text('internal_url');
            $table->softDeletes();
            $table->timestamps();

            $table->primary('photo_id');
            $table->foreign('username')
                ->references('username')
                ->on('Ulibier')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('photo_id')
                ->references('content_id')
                ->on('ContentBase')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        // Update Ulibier table - allow avatar
        Schema::table('UlibierProfile', function ($table) {
            $table->integer('avatar_id')->unsigned()->nullable();
            $table->integer('cover_id')->unsigned()->nullable();

            $table->foreign('avatar_id')
                ->references('photo_id')
                ->on('Photo')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('cover_id')
                ->references('photo_id')
                ->on('Photo')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        // Update Article table - add cover photo
        Schema::table('Article', function (Blueprint $table) {
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
        Schema::create('BlogPhotoMapping', function (Blueprint $table) {
            $table->string('blog_url')->unique();
            $table->integer('photo_id')->unsigned();

            $table->primary(array('blog_url', 'photo_id'));
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
        Schema::create('ArticlePhotoMapping', function (Blueprint $table) {
            $table->integer('article_id')->unsigned();
            $table->integer('photo_id')->unsigned();

            $table->primary(array('article_id', 'photo_id'));
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
        Schema::create('Destination', function (Blueprint $table) {
            $table->increments('des_id');
            $table->string('des_name');
            $table->text('des_instruction');
            $table->integer('prop_id')->unsigned();
        });
        DB::statement('ALTER TABLE Destination ADD coordinate GEOMETRY');
        Schema::table('Photo', function ($table) {
            $table->integer('des_id')->unsigned()->nullable();
            $table->foreign('des_id')
                ->references('des_id')
                ->on('Destination')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // Create table will map Article and Destination
        Schema::create('ArticleDestinationMapping', function (Blueprint $table) {
            $table->integer('article_id')->unsigned();
            $table->integer('des_id')
                ->unsigned();

            $table->primary(array('article_id', 'des_id'));
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
            $table->string('username');
            $table->integer('budget')->unsigned();
            $table->integer('visit_time')->unsigned();
            $table->string('vehicle');

            $table->primary(array('des_id', 'username'));
            $table->foreign('des_id')
                ->references('des_id')
                ->on('Destination')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('username')
                ->references('username')
                ->on('Ulibier')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // Tag
        Schema::create('Tag', function (Blueprint $table) {
            $table->increments('tag_id');
            $table->string('tag_name');
        });

        // Article Tag
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

        // Photo Like
        Schema::create('ContentLike', function (Blueprint $table) {
            $table->integer('content_id')->unsigned();
            $table->string('username');
            $table->timestamps();

            $table->primary(array('content_id', 'username'));
            $table->foreign('content_id')
                ->references('content_id')
                ->on('ContentBase')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('username')
                ->references('username')
                ->on('Ulibier')
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
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk=\Storage::disk();
        $disk->deleteDirectory('/imgtemp');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $tables=['UlibierPermission','Ulibier','UlibierProfile','ContentBase','Article','ArticlePhotoMapping','ArticleDestinationMapping','Comment','Blog','BlogPhotoMapping', 'Photo','Destination','Rate','Tag','ArticleTag', 'PhotoLike'];
        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}