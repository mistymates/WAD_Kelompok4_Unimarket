<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIpAddressAndUserAgentToSessionsTable extends Migration
{
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->string('ip_address')->nullable()->after('last_activity');
            $table->string('user_agent')->nullable()->after('ip_address');
        });
    }

    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropColumn('ip_address');
            $table->dropColumn('user_agent');
        });
    }
}
