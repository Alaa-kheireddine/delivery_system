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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();

            $table->string('tracking_number')->unique();

            $table->foreignId('branch_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('client_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('current_agent_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('current_branch_id')
                ->nullable()
                ->constrained('branches')
                ->nullOnDelete();

            $table->foreignId('destination_branch_id')
                ->nullable()
                ->constrained('branches')
                ->nullOnDelete();

            $table->string('receiver_name');
            $table->string('receiver_email');
            $table->string('receiver_phone');
            $table->string('receiver_city');
            $table->string('receiver_address');

            $table->text('description')->nullable();

            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->decimal('cod_amount', 10, 2)->default(0);

            $table->enum('payment_status', [
                'pending',
                'collected',
                'settled',
            ])->default('pending');

            $table->enum('status', [
                'pending',
                'assigned_to_collection',
                'collected',
                'in_stock',
                'assigned_to_transfer',
                'in_transit',
                'received_at_branch',
                'assigned_to_delivery',
                'out_for_delivery',
                'delivered',
                'rejected',
                'cancelled',
                'returned',
            ])->default('pending');

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'created_at']);

            $table->index(['client_id', 'created_at']);
            $table->index(['client_id', 'status']);

            $table->index(['branch_id', 'status']);
            $table->index(['branch_id', 'created_at']);

            $table->index(['current_branch_id', 'status']);

            $table->index(['current_agent_id', 'status']);

            $table->index(['destination_branch_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};

/*
|--------------------------------------------------------------------------
| Shipments Table Notes
|--------------------------------------------------------------------------
|
| هذا الجدول يمثل الشحنة نفسها، وليس كل تفاصيل الحركة.
|
| يحتوي فقط على:
| - بيانات التتبع
| - الفرع الأساسي والحالي
| - المستخدم الذي أنشأ الشحنة
| - العامل الحالي المسؤول عنها
| - بيانات المستلم
| - المبالغ المالية
| - الحالة الحالية للشحنة
|
| لا نخزن sender_name / sender_phone هنا لأن المرسل يأتي من:
| shipment -> creator(user) -> client
|
| لا نخزن collected_at / delivered_at / ... هنا لأن كل تغيير status
| يجب أن يسجل في جدول:
| shipment_status_histories
|
| القاعدة:
| shipments.status = الحالة الحالية فقط
| shipment_status_histories = التاريخ الكامل للحالات
|
| current_branch_id:
| يمثل مكان الشحنة الحالي.
| عند الإنشاء يفضّل أن يكون نفس branch_id.
|
| delivery_agent_id:
| يمثل العامل الحالي المسؤول عن المرحلة الحالية.
| ممكن يكون collector عند assigned_to_collector.
| وممكن يكون driver عند assigned_to_driver / out_for_delivery.
|
| payment_status:
| pending   = لم يتم قبض COD بعد
| collected = تم قبض COD من الزبون
| settled   = تمت تصفية المبلغ مع client
|
| status flow:
|
| pending
|   ↓
| assigned_to_collector
|   ↓
| collected
|   ↓
| in_stock
|   ↓
| ready_for_transfer
|   ↓
| in_transit
|   ↓
| received_at_branch
|   ↓
| in_stock
|   ↓
| assigned_to_driver
|   ↓
| out_for_delivery
|   ↓
| delivered
|
| حالات جانبية:
| pending / assigned_to_collector / in_stock → cancelled
| out_for_delivery → returned
|
| من يستخدم الحالات؟
|
| client:
| - يرى شحناته
| - يمكنه إلغاء الشحنة فقط إذا كانت pending
|
| manager:
| - يعين collector
| - يجهز transfer
| - يعين driver
| - يراقب شحنات فرعه
|
| collector:
| - يرى assigned_to_collector
| - يغيرها إلى collected
|
| warehouse:
| - يرى collected / in_transit / received_at_branch
| - يغيرها إلى in_stock
|
| transfer agent:
| - ينقل الشحنة بين الفروع
| - غالبًا لا يغير status إلا إذا قررتم إضافته لاحقًا
|
| delivery agent:
| - يرى assigned_to_driver / out_for_delivery
| - يغيرها إلى out_for_delivery ثم delivered أو returned
|
| admin:
| - يرى الكل
| - يتدخل للتصحيح حسب الصلاحيات
|
*/