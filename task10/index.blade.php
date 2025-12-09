<!-- resources/views/posts/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Список постов</title>
</head>
<body>
<h1>Посты</h1>
<a href="{{ route('posts.create') }}">Создать новый пост</a>
@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif
<ul>
@foreach($posts as $post)
    <li>
        <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
        [<a href="{{ route('posts.edit', $post) }}">Редактировать</a>]
        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Удалить?')">Удалить</button>
        </form>
    </li>
@endforeach
</ul>
</body>
</html>