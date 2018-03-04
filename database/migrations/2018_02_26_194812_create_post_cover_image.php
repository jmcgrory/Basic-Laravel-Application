<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCoverImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add cover image column
        Schema::table('posts', function($table){
            // Say what is added to the $table blueprint
            $table->string('cover_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Roll Back
        Schema::table('posts', function($table){
            // Say what is added to the $table blueprint
            $table->dropColumn('cover_image');
        });
    }
}
