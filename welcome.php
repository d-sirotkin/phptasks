<!doctype html>
<html>
    <head>
        <title>Task 1</title>
        <meta charset="utf-8">
        <link rel="icon" href="data:;base64,=">
    </head>
    <body>

    <!-- скрипт, который принимает имя и возраст
    через форму ($_GET), выводит приветствие и определяет,
    совершеннолетний ли человек -->


    <!-- форма для ввода данных -->
    <form method = 'get' action="">
        <input type = 'text' id = 'name' name = 'name' placeholder = 'Введите имя' required>
        <br><br>
        <input type = 'number' id = 'age' name = 'age' placeholder = 'Введите номер' required>
        <br><br>
        <input type = 'submit' value = 'Отправить'>
    </form>


    <?php 
        //обработываем данные при помощи get
        if (isset($_GET['name']) && isset($_GET['age'])){
            $name = htmlspecialchars($_GET['name']); // htmlspecialchars от xss
            $age = intval($_GET['age']);

            //проверям правильность введенного возраста и определяем статус
            if ($age < 0 || $age > 150) {
                echo 'Пожалуста, введите правильный возраст.';
                exit;
            }
            elseif ($age >= 18) {
                $status = 'совершеннолетний';
            }
            else {
                $status = 'несовершеннолетний';
            }

            //вывод
            echo '<p>Доброе время суток, $name. Вы $status.</p>';     
        }
    ?>


    </body>
</html>
