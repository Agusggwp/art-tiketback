<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_orders_table.php

public function up()

{

    Schema::create('orders', function (Blueprint $table) {

        $table->id();

        $table->string('name');

        $table->string('phone');

        $table->string('email')->nullable();

        $table->date('date');

        $table->text('notes')->nullable();

        

        // Data paket

        $table->unsignedBigInteger('package_id')->nullable();

        $table->string('package_title');

        $table->bigInteger('package_price');

        $table->bigInteger('total_price');

        

        $table->enum('status', ['baru', 'diproses', 'dihubungi', 'selesai'])->default('baru');

        $table->timestamps();

    });

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
