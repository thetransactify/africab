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
        Schema::create('order_update', function (Blueprint $table) {
            $table->id();
            $table->string('order_group_id')->index();
            $table->unsignedTinyInteger('order_status')->default(1);
            $table->unsignedTinyInteger('payment_status')->default(1);
            $table->string('shipper_name')->nullable();
            $table->string('tracking_no')->nullable();
            $table->string('custom_message', 500)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_update');
    }
};
