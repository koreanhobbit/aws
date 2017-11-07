<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProfilesocialmediasUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('profilesocialmedias_users', function (Blueprint $table) {
            $table->unsignedInteger('profilesocialmedia_id');
            $table->unsignedInteger('user_id');
            $table->unique(['profilesocialmedia_id', 'user_id']);
            $table->foreign('profilesocialmedia_id')->references('id')->on('profilesocialmedias')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('link')->nullable();
        });
        Schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('profilesocialmedias_users');
        Schema::enableForeignKeyConstraints();
    }
}
