<!-- resources/views/posts/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Создать пост</title>
</head>
<body>
<h1>Создать новый пост</h1>
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <label>Заголовок:</label><br>
    <input type="text" name="title" value="{{ old('title') }}"><br>
    @error('title')<div style="color:red;">{{ $message }}</div>@enderror
    <br>
    <label>Контент:</label><br>
    <textarea name="content">{{ old('content') }}</textarea><br>
    @error('content')<div style="color:red;">{{ $message }}</div>@enderror
    <br>
    <button type="submit">Создать</button>
</form>
<a href="{{ route('posts.index') }}">Вернуться к списку</a>
</body>
</html>