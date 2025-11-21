<?php
//параметры подключения
$host = 'localhost';
$db_name = 'blog';
$username = 'root';
$password = '123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка соединения: " . $e->getMessage());
}

// обработка добавления поста
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->execute([$title, $content]);
}

// обработка удаления поста
if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$delete_id]);
}

// получение всех постов
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();

#БД phpMyAdmin
# CREATE DATABASE blog;
# USE blog;

# CREATE TABLE posts (
#    id INT AUTO_INCREMENT PRIMARY KEY,
#    title VARCHAR(255) NOT NULL,
#    content TEXT NOT NULL,
#    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
# );
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <title>Task 5</title>
</head>
<body>
    <h1>Список постов</h1>
    <a href = "#addForm">Добавить новый пост</a>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
                <h2><?= htmlspecialchars($post['title']) ?></h2>
                <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                <small>Дата: <?= $post['created_at'] ?></small>
                <br>
                <a href = "?delete=<?= $post['id'] ?>" onclick = "return confirm('Удалить этот пост?')">Удалить</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2 id = "addForm">Добавить пост</h2>
    <form method = "post" action = "#addForm">
        <label>Заголовок:<br>
            <input type = "text" name = "title">
        </label><br><br>
        <label>Содержание:<br>
            <textarea name = "content" rows = "5"></textarea>
        </label><br><br>
        <button type = "submit">Добавить</button>
    </form>
</body>
</html>
