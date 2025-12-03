<?php
// Создать форму регистрации с полями: имя, email,
// пароль. Принять данные, проверить email на валидность (filter_var()),
// вывести их в виде ассоциативного массива




if ($_SERVER['REQUEST_METHOD'] === 'POST'){
   

    /* name */
    //массив для хранения ошибок    
    $errors = [];
    // и массив для хранения валидных данных пользователя
    $userData = [];


    if (isset($_POST['name'])) {

       
    //обрезаем пробелы
    $name = trim($_POST['name']);

    // проверка длины
    if (strlen($name) < 8) {
        $errors[] = "Имя пользователя должно быть больше 8 символов.";
    } elseif (strlen($name) > 30) {
        $errors[] = "Имя пользователя не должно превышать 30 символов.";
    } elseif (!preg_match('/^[a-zA-Z0-9_\-\.а-яА-ЯёЁ]+$/u', $name )){
        $errors[] = "Имя пользователя содержит недопустимые символы";  // проверка недопустимых символов
    }
    if(empty($errors)){
    //если проверки прошли успешно, добавим валидное имя в массив
    $userData['name'] = $name;
    }
}



/* email */

    // здесь можно безопасно использовать $_POST['email']
    if (isset($_POST['email'])) {
        // обрезаем пробелы
        $email = trim($_POST['email']);
        
        // проверка, что поле не пустое
        if (empty($email)){
            $errors[] = "Форма не заполнено. Пожалуйста, введите почту.";
        } elseif (!filter_var($email, FILTER_SANITIZE_EMAIL)){
            $errors[] = "Некорректный формат почты."; // санитизация email
        }

        if(empty($errors)){
        //если проверки прошли успешно, добавим валидное имя в массив
            $userData['email'] = $email; 
        }

    }




/* password */
    if (isset($_POST['password'])) {
        
    ///^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/
    //или
    if(strlen($password) > 8){
        $errors[] = "Пароль должен быть больше 8 символов.";
    } elseif (preg_match('/[A-Z]/', $password)){
        $errors[] = "Добавитье хотя бы одну заглавную букву.";
    } elseif (preg_match('/[a-z]/', $password)){
        $errors[] = "Добавитье хотя бы одну строчную букву.";
    } elseif (preg_match('/\d/', $password)){
        $errors[] = "Добавитье хотя бы одну цифру.";
    } elseif (preg_match('/[\W_]/', $password)){
        $errors[] = "Добавитье хотя бы один специальный символ.";
    }
    // здесь можно продоложить обработку

    else{
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $userData['password'] = $hashed_password;
        // сохраним $hashed_password в бд через pdo 
    }
}


    /* вывод данных в ассоциативном массиве */
    if (empty($errors)) {
        //если нет ошибок, то все данные валидны
        //в этом блоке как раз можно сохранить данные в бд или передать дальше
        
        echo "<pre>";
            print_r($userData);
        echo "</pre>";

    } else {
        //если есть ошибки, то выводим
        foreach ($errors as $error){
            echo htmlspecialchars($error) . '<br>';
        }
        echo "<br/><a href=\"index.php\">Вернуться назад</a>";
    }
}
