<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCacheTable extends Migration
{
    public function up()
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->unique(); // Cache key
            $table->text('value'); // Cached value
            $table->integer('expiration'); // Cache expiration time
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cache');
    }
}
