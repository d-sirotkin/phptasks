<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Вывести список постов
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    // Показать форму создания нового поста
    public function create()
    {
        return view('posts.create');
    }

    // Обработка данных формы для создания нового поста
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
        
        Post::create($validated);
        return redirect()->route('posts.index')->with('success', 'Пост создан');
    }

    // Показать пост
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Показать форму редактирования
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Обработка данных формы для обновления поста
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
        
        $post->update($validated);
        return redirect()->route('posts.index')->with('success', 'Пост обновлен');
    }

    // Удаление поста
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Пост удален');
    }
}
