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
            $table->foreignId('branch_id')
                ->after('id')
                ->nullable()
                ->constrained('branches')
                ->nullOnDelete();

            $table->foreignId('role_id')
                ->after('branch_id')
                ->constrained('roles')
                ->restrictOnDelete();

            $table->index('role_id');
            $table->index('branch_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
            $table->dropConstrainedForeignId('role_id');
        });
    }
};
