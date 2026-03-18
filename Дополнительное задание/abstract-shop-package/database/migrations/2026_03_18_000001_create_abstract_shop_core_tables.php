<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('abstract_shop_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('parent_id')->nullable()->constrained('abstract_shop_categories')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('abstract_shop_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });

        Schema::create('abstract_shop_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });

        Schema::create('abstract_shop_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->timestamps();
        });

        Schema::create('abstract_shop_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique();
            $table->decimal('price', 12, 2);
            $table->string('currency', 3)->default('RUB');
            $table->foreignId('category_id')->nullable()->constrained('abstract_shop_categories')->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('abstract_shop_suppliers')->nullOnDelete();
            $table->foreignId('warehouse_id')->nullable()->constrained('abstract_shop_warehouses')->nullOnDelete();
            $table->unsignedInteger('stock')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('abstract_shop_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('abstract_shop_customers')->nullOnDelete();
            $table->string('status')->default('NEW');
            $table->string('currency', 3)->default('RUB');
            $table->decimal('total', 12, 2)->default(0);
            $table->string('from_address')->nullable();
            $table->string('to_address')->nullable();
            $table->decimal('delivery_distance_km', 10, 2)->nullable();
            $table->decimal('delivery_price', 12, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('abstract_shop_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('abstract_shop_orders')->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained('abstract_shop_products')->nullOnDelete();
            $table->string('product_name');
            $table->decimal('price', 12, 2);
            $table->unsignedInteger('qty');
            $table->decimal('line_total', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abstract_shop_order_items');
        Schema::dropIfExists('abstract_shop_orders');
        Schema::dropIfExists('abstract_shop_products');
        Schema::dropIfExists('abstract_shop_warehouses');
        Schema::dropIfExists('abstract_shop_customers');
        Schema::dropIfExists('abstract_shop_suppliers');
        Schema::dropIfExists('abstract_shop_categories');
    }
};

