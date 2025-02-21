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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        DB::table('products')->insert([
            [
                'name' => 'Товар 1',
                'category_id' => 1,
                'description' => 'Описание товара 1',
                'price' => 199.99,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Товар 2',
                'category_id' => 2,
                'description' => 'Описание товара 2',
                'price' => 299.99,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Товар 3',
                'category_id' => 3,
                'description' => 'Описание товара 3',
                'price' => 399.99,
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
        Schema::dropIfExists('products');
    }
};
