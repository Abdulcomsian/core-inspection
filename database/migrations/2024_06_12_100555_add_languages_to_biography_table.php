<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('biography', function (Blueprint $table) {
            $table->json('languages')->after('nin_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biography', function (Blueprint $table) {
            if (Schema::hasColumn('biography', 'languages')) {
                $table->dropColumn('languages');
            }
        });
    }
};
