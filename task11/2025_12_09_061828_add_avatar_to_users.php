<?php

//php artisan make:migration add_avatar_to_users --table=users
// --->
//INFO  Migration [database/migrations/2025_12_09_061828_add_avatar_to_users.php] created successfully.


//в database/migrations/2025_12_09_061828_add_avatar_to_users.php


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
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

//php artisan migrate

// INFO  Running migrations.  
// 2025_12_09_061828_add_avatar_to_users ........................................................ 7.62ms DONE

//в модели User.php добавим 'avatar'

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];


// в Blade-шаблоне добавим форму
// resources/views/profile.blade.php

<h2>Мой профиль</h2>

@if ($user->avatar)
    <img src="{{ Storage::url($user->avatar) }}" alt="Аватар" width="100">
@endif

// форма для загрузки нового аватара
<form action="{{ route('profile.uploadAvatar') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="avatar" accept="image/*" required>
    <button type="submit">Загрузить аватар</button>
</form>


//сорздание маршрута и контроллера для обработки закгрузки в routes/web.php
use App\Http\Controllers\ProfileController;

Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.uploadAvatar');

//создадим контроллер через терминал, введя команду php artisan make:controller ProfileController
//INFO  Controller [app/Http/Controllers/ProfileController.php] created successfully.

// в ProfileController.php добавим

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2048', // max 2MB
        ]);

        $user = Auth::user();

        // Обработка файла
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/avatars', $filename);
            
            // Удаление старого аватара (если есть)
            if ($user->avatar) {
                \Storage::delete($user->avatar);
            }

            // Обновление пути в базе
            $user->update(['avatar' => $path]);
        }

        return back()->with('status', 'Аватар успешно загружен');
    }
}


//после чего выведем аватар в шаблоне

@if ($user->avatar)
    <img src="{{ Storage::url($user->avatar) }}" alt="Аватар" width="100">
@endif