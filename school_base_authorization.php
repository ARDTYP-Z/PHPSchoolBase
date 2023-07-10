<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authorization</title>
    <link rel="stylesheet" type="text/css" href="school_base.css">
    <link rel="stylesheet" type="text/css" href="school_base_authorization.css">
</head>
<body>

<h1>School Authorization</h1>
<h2>Please, enter your username and password</h2>

<form class="form" method="post">
    <div class="form_to_center">
        <div class="form_left">
            <input placeholder="Username" class="input_color" type="text" name="username">
        </div>
        <div class="form_right">
            <input placeholder="Password" class="input_color" type="password" name="password">
        </div>
    </div>
    <div class="input_buttons">
        <input class="input_first_button" type="submit" value="Submit" name="submit" style="margin: 10px 0 0 430px" />
        <input class="input_second_button" type="button" value="Registration" onclick="window.location.href = 'school_base_registration.php';" />
    </div>
</form>

<?php

$server = 'localhost'; // 127.0.0.1
$user = 'root';
$password = '';
$database = 'SCHOOL_INFO';
$port = 3306;
$table = 'school_registration';

// Подключение к серверу mysql
$server_connection = new mysqli($server, $user, $password, $database, $port);
if ($server_connection->connect_errno) {
    /* Используйте предпочитаемый вами метод регистрации ошибок */
    die('Ошибка соединения: ' . $mysqli->connect_errno);
}
/* изменение кодировки на utf8mb4 */
$server_connection->set_charset("utf8mb4");

$username_base = 'SELECT username FROM SCHOOL_INFO.school_registration';
$usernames_base = $server_connection->query($username_base)->fetch_all();

$username_input = null;
$password_input = null;

if (isset($_POST['username']) && isset($_POST['password'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username_input = $_POST['username'];
        $password_input = $_POST['password'];

        session_start();
        $_SESSION['username'] = $_POST['username'];

        $isUsername = false;
        $isPassword = false;

        foreach ($usernames_base as $item) {
            foreach ($item as $username_base) {
                if ($username_input == $username_base) {
                    $isUsername = true;
                }
            }
        }

        $password_base = "SELECT password FROM SCHOOL_INFO.school_registration WHERE username = '$username_input'";
        $passwords_base = $server_connection->query($password_base)->fetch_all();

        foreach ($passwords_base as $item) {
            foreach ($item as $password_base) {
                if ($password_input == $password_base) {
                    $isPassword = true;
                }
            }
        }


        if ($isUsername && $isPassword) {
            ?>
            <p class="good_auntification">Your auntification done!</p>
            <?php

            $level_base = "SELECT level FROM SCHOOL_INFO.school_registration WHERE username = '$username_input'";
            $level = $server_connection->query($level_base)->fetch_all();

            if (!empty($level)) {
                foreach ($level as $item) {
                    foreach ($item as $level) {
                        if ($level == 'Student') {
                            header('Location: school_base_student.php');
                            exit;
                        } elseif ($level == 'Teacher') {
                            header('Location: school_base_teacher.php');
                            exit;
                        } elseif ($level == 'Director') {
                            header('Location: school_base_director.php');
                            exit;
                        } elseif ($level == 'Admin') {
                            header('Location: school_base_admin.php');
                            exit;
                        } else {
                            ?>
                            <p class="error_auntification">
                                Your level isn't find in DataBase.
                            </p>
                            <?php
                        }
                    }
                }
            }


        }

        if (!$isUsername || !$isPassword) {
            ?>
            <p class="error_auntification">
                Wrong information or information doesn't exist. <br>
                You can go for registration or <br>
                put your values one time more.
            </p>
            <?php
        }
    } else {
        ?>
        <p class="error_auntification">
            Please, put all information about yourself.
        </p>
        <?php
    }
}
?>

</body>
</html>
