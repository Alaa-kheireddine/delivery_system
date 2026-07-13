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
        Schema::table('users', function (Blueprint $table) {
            // Btbayyen eza l user lezem yghayer l password abl ma yefout 3al system.
            $table->boolean('must_change_password')->after('password')->default(false);

            // Bte7faz ta2riban la ayemta l temporary password bado ydal valid.
            // Eza entaha l wa2et, ma by2dar ya3mel login b hal password l mwa2at.
            $table->timestamp('temporary_password_expires_at')->after('must_change_password')->nullable();

            // Bte7faz wa2et aymta l user ghayar l password successfully.
            // Momken nesta3mela ba3den lal audit aw l reports.
            $table->timestamp('password_changed_at')->after('temporary_password_expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
