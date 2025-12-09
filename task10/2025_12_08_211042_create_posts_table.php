<?php

//php artisan make:controller PostController --resource
//для создания PostController.php с методами для CRUD


//далее настроим маршрутизацию в web.php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
Route::resource('posts', PostController::class);
//.....


//php artisan make:model Post -m

//INFO  Migration [database/migrations/2025_12_08_211042_create_posts_table.php] created successfully.
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

//php artisan migrate




// INFO  Model [app/Models/Post.php] created successfully.  

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description'];
}



//php artisan serve  
//http://127.0.0.1:8000/posts