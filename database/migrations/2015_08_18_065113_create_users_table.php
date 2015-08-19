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
        // Create ulibier table
        Schema::create('Ulibier', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('sex');
            $table->date('birthday');
            $table->string('email');
            $table->string('phonenumber');
            $table->string('nationality');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('blog_url');
            // $table->integer('avatar_id'); - modify at next migration
            $table->string('report');
        });

        // Create article table
        Schema::create('Article', function (Blueprint $table) {
            $table->increments('article_id');
            $table->integer('user_id')->unsigned();
            $table->integer('article_like')->unsigned();
            $table->string('article_content');
            $table->datetime('article_date');
            $table->integer('view')->unsigned();

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
            $table->integer('user_id')->unsigned();
            $table->integer('blog_background')->unsigned();
            $table->integer('blog_view')->unsigned();

            $table->primary('blog_url');
            $table->foreign('user_id')
                ->references('user_id')
                ->on('Ulibier')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        // Create table will map Blog and Article
        Schema::create('BlogArticleMapping', function (Blueprint $table) {
            $table->string('blog_url')->unique();
            $table->integer('article_id')->unsigned();

            $table->primary(array('blog_url','article_id'));
            $table->foreign('blog_url')
                ->references('blog_url')
                ->on('Blog')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('article_id')
                ->references('article_id')
                ->on('Article')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // Create photo table
        Schema::create('Photo', function (Blueprint $table) {
            $table->increments('photo_id');
            $table->integer('photo_like')->unsigned();
            $table->integer('user_id')->unsigned();
            // $table->integer('des_id')->unsigned();
            // [VN] mỗi tấm ảnh chỉ thuộc về 1 địa điểm, 1 địa điểm có thể có nhiều ảnh :)
            $table->dateTime('photo_uptime');

            $table->foreign('user_id')
                ->references('user_id')
                ->on('Ulibier')
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

        // Create destination table
        Schema::create('Destination', function(Blueprint $table) {
            $table->increments('des_id');
            $table->string('des_instruction');
            $table->integer('budget');
            $table->integer('avg_budget');
            $table->integer('visit_time');
            $table->integer('avg_time');
            $table->string('vehicle');
            $table->string('pref_vehicle');
            // $table->integer('prop_id')->unsigned();
        });
        DB::statement('ALTER TABLE Destination ADD coordinate POINT' );
        // update table Article: add destination column
        Schema::table('Article', function(Blueprint $table) {
            $table->integer('des_id')
                ->after('user_id')
                ->unsigned();
            // [VN] Mỗi bài viết chỉ viết về một địa điểm
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $tables=['Ulibier','Article','Comment','Blog','BlogArticleMapping','BlogPhotoMapping',
            'Photo','Destination','Rate'];
        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
