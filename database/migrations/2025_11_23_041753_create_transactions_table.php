<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->string('invoice')->unique();
            $table->unsignedBigInteger('package_id');

            $table->integer('qty')->default(1);
            $table->bigInteger('total_amount');

            $table->string('buyer_name')->nullable();
            $table->string('buyer_email')->nullable();

            $table->enum('status', ['pending', 'paid', 'failed'])
                  ->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
