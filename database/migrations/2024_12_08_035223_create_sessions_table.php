<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->unique(); // The unique session ID
            $table->text('payload');         // The session data (serialized)
            $table->integer('last_activity'); // The last time the session was active
            $table->timestamps();            // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
