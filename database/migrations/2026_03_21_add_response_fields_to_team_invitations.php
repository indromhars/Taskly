<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('team_invitations', function (Blueprint $table) {
            $table->timestamp('responded_at')->nullable();
            $table->string('response')->nullable(); // 'accepted' or 'rejected'
        });
    }

    public function down()
    {
        Schema::table('team_invitations', function (Blueprint $table) {
            $table->dropColumn(['responded_at', 'response']);
        });
    }
};
