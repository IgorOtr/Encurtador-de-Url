<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('short_urls', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable()->after('short_code');
        });
    }

    public function down()
    {
        Schema::table('short_urls', function (Blueprint $table) {
            $table->dropColumn('expires_at');
        });
    }
};
