<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->enum('sex',['male','fmale','other']);
            $table->string('bio')->nullable();
            $table->string('avatar')->default('boy.png');
            $table->string('email')->nullable();
            $table->string('password');
            $table->integer('balance')->default(0);
            $table->timestamp('last_seen')->nullable();
            $table->timestamp('online_from')->nullable();
            $table->enum('role',['user','admin','superadmin'])->default('user');
            $table->boolean('status')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
