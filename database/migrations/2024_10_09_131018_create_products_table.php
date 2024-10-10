<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->unsigned();
            $table->unsignedBigInteger('operation_id')->unsigned();
            $table->unsignedBigInteger('product_type_id')->unsigned();
            $table->text('description');
            $table->float('weight');
            $table->string('image');
            $table->date('receive_date');
            $table->date('due_date');
            $table->date('delivery_date');
            $table->float('price');
            $table->text('note');
            $table->unsignedBigInteger('material_type_id');
            $table->float('material_weight');
            $table->unsignedBigInteger('status_id')->unsigned();

            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->foreign('operation_id')->references('id')->on('operation_types')->cascadeOnDelete();
            $table->foreign('product_type_id')->references('id')->on('product_types')->cascadeOnDelete();
            $table->foreign('material_type_id')->references('id')->on('material_types')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
