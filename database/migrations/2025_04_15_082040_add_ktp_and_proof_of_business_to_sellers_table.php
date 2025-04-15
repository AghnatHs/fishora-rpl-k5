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
        Schema::table('sellers', function (Blueprint $table) {
            $table->longText('ktp')->charset('binary')->nullable();
            $table->string('ktp_mime')->nullable();
            $table->longText('proof_of_business')->charset('binary')->nullable();
            $table->string('proof_of_business_mime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn('ktp');
            $table->dropColumn('ktp_mime');
            $table->dropColumn('proof_of_business');
            $table->dropColumn('proof_of_business_mime');
        });
    }
};
