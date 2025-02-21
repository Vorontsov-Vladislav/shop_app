<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->enum('status', ['новый', 'выполнен'])->default('новый');
            $table->text('comment')->nullable();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });

        DB::table('orders')->insert([
            [
                'customer_name' => 'Иван Иванов',
                'status' => 'новый',
                'comment' => 'Первый заказ',
                'product_id' => 1,
                'quantity' => 2,
                'total_price' => 399.98,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'customer_name' => 'Петр Петров',
                'status' => 'новый',
                'comment' => 'Второй заказ',
                'product_id' => 2,
                'quantity' => 1,
                'total_price' => 299.99,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
