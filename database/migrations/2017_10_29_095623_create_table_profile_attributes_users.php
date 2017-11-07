<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProfileAttributesUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('profile_attributes_users', function (Blueprint $table) {
            $table->unsignedInteger('profileattribute_id');
            $table->unsignedInteger('user_id');
            $table->unique(['profileattribute_id', 'user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('profileattribute_id')->references('id')->on('profileattributes')->onDelete('cascade');
            $table->string('value')->nullable();
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
        Schema::dropIfExists('profile_attributes_users');
        Schema::enableForeignKeyConstraints();
    }
}
