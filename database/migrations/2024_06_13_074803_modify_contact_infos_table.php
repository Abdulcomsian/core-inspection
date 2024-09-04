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
        Schema::table('contact_infos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::rename('contact_infos', 'identities');

        Schema::table('identities', function (Blueprint $table) {
            if (Schema::hasColumn('identities', 'phone_no')) {
                $table->dropColumn('phone_no');
            }

            $table->renameColumn('cnic_no', 'national_id_number');
            $table->renameColumn('cnic_image', 'national_id_image');
        });

        // Add foreign key constraint back to 'user_id'
        Schema::table('identities', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identities');
    }
};
