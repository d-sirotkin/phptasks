<!-- resources/views/posts/edit.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Редактировать пост</title>
</head>
<body>
<h1>Редактировать пост</h1>
<form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Заголовок:</label><br>
    <input type="text" name="title" value="{{ old('title', $post->title) }}"><br>
    @error('title')<div style="color:red;">{{ $message }}</div>@enderror
    <br>
    <label>Контент:</label><br>
    <textarea name="content">{{ old('content', $post->content) }}</textarea><br>
    @error('content')<div style="color:red;">{{ $message }}</div>@enderror
    <br>
    <button type="submit">Обновить</button>
</form>
<a href="{{ route('posts.index') }}">Вернуться к списку</a>
</body>
</html>