<?php

//php artisan make:model Comment -m


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
            Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Связь с posts
            $table->text('content');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

//Выполним миграцию php artisan migrate 

//через тинкер

use App\Models\Post;
use App\Models\Comment;

//Создадим пост с id=1
/*
Comment::create([
    'post_id' => 1,
    'content' => 'Это комментарий к посту 1'
]);
*/