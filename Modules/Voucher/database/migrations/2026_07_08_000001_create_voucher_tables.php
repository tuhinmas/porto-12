<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('voucher_organizations')) {
            Schema::create('voucher_organizations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('organization_id')->nullable();
                $table->unsignedBigInteger('store_id')->nullable();
                $table->string('name');
                $table->string('code')->unique();
                $table->date('start_at');
                $table->date('end_at');
                $table->string('type');
                $table->decimal('amount', 12, 2)->default(0);
                $table->integer('total_quantity')->default(0);
                $table->integer('used_count')->default(0);
                $table->boolean('is_active')->default(true);
                $table->decimal('min_transaction', 12, 2)->default(0);
                $table->decimal('max_discount_amount', 12, 2)->nullable();
                $table->boolean('is_stackable')->default(true);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('vouchers')) {
            Schema::create('vouchers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('organization_id')->nullable();
                $table->unsignedBigInteger('store_id')->nullable();
                $table->unsignedBigInteger('voucher_org_id')->nullable();
                $table->string('name');
                $table->string('code')->unique();
                $table->date('start_at');
                $table->date('end_at');
                $table->string('type');
                $table->decimal('amount', 12, 2)->default(0);
                $table->integer('total_quantity')->default(0);
                $table->integer('used_count')->default(0);
                $table->boolean('is_active')->default(true);
                $table->decimal('min_transaction', 12, 2)->default(0);
                $table->decimal('max_discount_amount', 12, 2)->nullable();
                $table->boolean('is_stackable')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
        Schema::dropIfExists('voucher_organizations');
    }
};
