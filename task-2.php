<! doctype html>
<html>
    <head>
        <title>Task 2</title>
        <meta charset="utf-8">
        <link rel="icon" href="data:;base64,=">
    </head>
    <body>

        <!-- Создать форму регистрации с полями: имя, email,
        пароль. Принять данные, проверить email на валидность (filter_var()),
        вывести их в виде ассоциативного массива. -->


        <!-- Форма -->
        <form method = 'post' action = ''?>
            <input type = 'text' name = 'text' placeholder = 'Введите имя' required>
            <input type = 'email' name = 'email' placeholder = 'Введите почту' required>
            <input type = 'password' name = 'password' placeholder = 'Введите пароль' required>
            <button type = 'submit'></button>
        </form>


        <!-- Скрипт для обработки формы-->
    <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //получение данных из формы
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
        }

        //данные в массив
        $userData = [
            'name'=> $name,
            'email'=> $email,
            'password' => $password
        ];
        

        //проверка данных на валидность
        if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            $email_valid = true;
        }
        else {
            $email_valid = false;
        }


        //вывод данных
        echo '<pre>';
        print_r(($userData));
        echo '<pre>';


        //вывод сообщения о валидности email
        if ($email_valid) {
            echo '<p> Почта валидна </p>';
        }
        else {
            echo '<p> Неккоректный формат почты </p>';
        }

    ?>
    </body>
</html>
