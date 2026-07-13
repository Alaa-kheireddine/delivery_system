<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipment_status_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('shipment_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('from_status')->nullable();
            $table->string('to_status');

            $table->foreignId('changed_by_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('reason')->nullable();
            $table->text('notes')->nullable();

            $table->timestamp('changed_at')->useCurrent();

            $table->timestamps();

            $table->index(['shipment_id', 'changed_at']);
            $table->index(['to_status', 'changed_at']);
            $table->index('changed_by_user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipment_status_histories');
    }
};

/*

shipment_id
الشحنة التي تغيّرت حالتها.

from_status
الحالة السابقة.
تكون null عند إنشاء الشحنة لأول مرة.

to_status
الحالة الجديدة.

changed_by_user_id
المستخدم الذي نفّذ التغيير:
Client / Manager / Operations / Driver / Admin.

reason
سبب مختصر للتغيير.
مهم بالرفض، الإلغاء، فشل التوصيل والإرجاع.

notes
تفاصيل إضافية اختيارية.

changed_at
الوقت الفعلي الذي تغيّرت فيه الحالة.
->useCurrent() , krmel ykoun default value now() eza nsina n7oto bl code

*/