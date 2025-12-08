<?php
//php artisan make:model Product -m
//для создания модели Product и этого файла миграции

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

//После php artisan migrate

//php artisan tinker, чтобы добавить 5 записей:

/*
use App\Models\Product;

Product::create([
    'name' => 'Product 1',
    'price' => 99.99,
    'description' => 'Description for product 1'
]);

Product::create([
    'name' => 'Product 1',
    'price' => 99.99,
    'description' => 'Description for product 1'
]);


Product::create([
    'name' => 'Product 2',
    'price' => 149.50,
    'description' => 'Description for product 2'
]);

Product::create([
    'name' => 'Product 3',
    'price' => 79.00,
    'description' => 'Description for product 3'
]);

Product::create([
    'name' => 'Product 4',
    'price' => 199.99,
    'description' => 'Description for product 4'
]);

Product::create([
    'name' => 'Product 5',
    'price' => 59.99,
    'description' => 'Description for product 5'
]);
*/