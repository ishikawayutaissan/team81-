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
            $table->increments('id');
            $table->tinyInteger('role')->unsigned();    //>default(0)      
            $table->string('company')->nullable();
            $table->string('department')->nullable();
            $table->string('position', 64)->nullable();
            $table->string('name');    
            $table->string('tel',16);
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('URLtoken')->nullable();
            $table->datetime('applied_at')->nullable();
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