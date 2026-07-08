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
        Schema::create('client_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('amount', 12, 2);

            $table->date('payment_date');

            $table->enum('payment_method', [
                'cash',
                'bank_transfer',
                'omt',
                'wish',
                'other',
            ])->default('cash');

            $table->string('reference')->nullable();

            $table->text('notes')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['client_id', 'payment_date']);
            $table->index(['client_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_payments');
    }
};
