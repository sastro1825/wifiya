<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('warnings', function (Blueprint $table) {
            $table->timestamp('sent_at')->nullable()->after('message');
        });
    }

    public function down(): void
    {
        Schema::table('warnings', function (Blueprint $table) {
            $table->dropColumn('sent_at');
        });
    }
};