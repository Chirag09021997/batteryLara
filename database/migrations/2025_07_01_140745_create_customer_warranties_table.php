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
        Schema::create('customer_warranties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('installer_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_warranty_id');
            $table->string('vehicle_brand')->nullable();
            $table->string('model_name')->nullable();
            $table->string('year')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('vin_no')->nullable();
            $table->json('installation_images')->nullable();
            $table->date('date_of_installation')->default(now());
            $table->string('product_lot_no')->nullable();
            $table->string('product_serial_no')->nullable();
            $table->enum('warranty_status', ['Active', 'DeActive']);
            $table->string('warranty_reason')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('installer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_warranty_id')->references('id')->on('product_warranties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_warranties');
    }
};
