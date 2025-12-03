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

    if (!isset($_POST['name'])) {
        $errors[] = "Пожалуйста, введите имя пользователя." . ;
    }
    
    //обрезаем пробелы
    $name = trim($_POST['name']);

    // проверка длины
    if (strlen($name) < 8) {
        $errors[] = "Имя пользователя должно быть больше 8 символов.";
    }
    elseif (strlen($name) > 30) {
        $errors[] = "Имя пользователя не должно превышать 30 символов.";
    }
    // проверка недопустимых символов
    elseif (!preg_match('/^[a-zA-Z0-9_\-\.а-яА-ЯёЁ]+$/u', $name )){
        $errors[] = "Имя пользователя содержит недопустимые символы.";
    }
    elseif (htmlspecialchars($name)){
        $errors[] = "Имя пользователя содержит недопустимые символы.";
    }
    else {
        //если проверки прошли успешно, добавим валидное имя в массив
        $userData['name'] = $name;
    }


/*
    // дополнительная проверка на запрещенные слова 
    // список запрещенных слов
    $blockedWords = ['собака', 'грызть', 'мебель'];

    // перебираем список запрещенных слов
    foreach ($blockedWords as $word) {
        //проверка на содержание запрещенного слова в никнейме
        if (strpos($name, $word) !== false) {
            echo "Простите, но использование слова '$word' в никнейме запрещено!";
        }
    }
*/




/* email */

    // здесь можно безопасно использовать $_POST['email']
    if (!isset($_POST['email'])) {
        // обрезаем пробелы
        $email = trim($_POST['email']);
        
        // проверка, что поле не пустое
        if (empty($email)){
            $errors[] = "Форма не заполнено. Пожалуйста, введите почту.";
        }
        // санитизация email
        elseif (!filter_var($email, FILTER_SANITIZE_EMAIL)){
            $errors[] = "Некорректный формат почты.";
        }
        else{
            $userData['email'] = $email; 
        }

    /*
    // валидация
    if (filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Почта валидна:" . htmlspecialchars($sanitizedEmail);
    }*/
}






/* password */
    if (isset($_POST['password'])) {
        
    
    ///^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/
    //или
    if(strlen($password) < 8){
        $errors[] = "Пароль должен быть больше 8 символов.";
    }
    elseif (!preg_match('/[A-Z]/', $password)){
        $errors[] = "Добавьте заглавные буквы.";
    }
    elseif (!preg_match('/[a-z]/', $password)){
        $errors[] = "Добавьте строчные буквы.";
    }
    elseif (!preg_match('/\d/', $password)){
        $errors[] = "Добавьте хотя бы одну цифру.";
    }
    elseif (!preg_match('/[\W_]/', $password)){
        $errors[] = "Добавьте хотя бы один специальный символ.";
    }
    // здесь можно продоложить обработку

    //добавить провеку на наличие пароля в бд (?), но в аунтификации
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
               
    }
    else {
        //если есть ошибки, то выводим
        foreach ($errors as $error){
            echo htmlspecialchars($error) . '<br>';
        }
        echo "<br/><a href=\"index.php\">Вернуться назад</a>";
    }

}
