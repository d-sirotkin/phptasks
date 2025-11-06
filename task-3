<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Task 3</title>
        <link rel="icon" href="data:;base64,=">
    </head>
    <body>


    <?php
        session_start();

        if (isset($_SESSION['visit_count'])) {
            $_SESSION['visit_count'] += 1;
            $message = "С возвращением.. <br>" . $_SESSION['visit_count'];
        }
        else {
            $_SESSION['visit_count'] = 1;  
            $message = "Привествую.. <br>" . $_SESSION['visit_count'];
        }
    ?>


    <p><?php echo $message ?></p>


    </body>
</html>
