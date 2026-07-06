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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // Company / Store name
            $table->string('code')->unique(); // moufid lal fawatir w search

            $table->decimal('total_client_earnings', 12, 2)->default(0); // majmou3 l masare li tala3on ma3na 
            $table->decimal('current_balance', 12, 2)->default(0); // adech elon 3layna masare 7aliyan m ndafa3it, byn2as lama ndfa3 
            $table->decimal('total_paid_amount', 12, 2)->default(0); // ade majmou3 li dafa3nelo ye

            $table->decimal('default_delivery_fee', 10, 2)->nullable(); // ade metef2in ne5od 3a kl towsile ka default

            $table->string('contact_person_name')->nullable(); // min mas2oul l cherke ( mmkn ykoun hwe zeto l user)
            $table->string('phone')->nullable();// email w phone l cherke 
            $table->string('email')->nullable();

            $table->string('city')->nullable(); // lcherke he mawka3a wen
            $table->string('address')->nullable();

            $table->foreignId('branch_id') // ayya fere3 a2rab chi elo w hwe byt3ata ma3o // eza nma7a l fere3 bidal l client mawjoud bas branch_id btsir null
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->boolean('is_active')->default(true);

            $table->text('notes')->nullable(); // msln eno dafe3 osbou3e, pickup after 4 pm

            $table->timestamps();

            $table->index(['branch_id', 'is_active']);
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
