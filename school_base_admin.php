<!
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="school_base.css">
    <link rel="stylesheet" type="text/css" href="school_base_admin.css">
</head>
<body>

<h1>Your level is ADMIN</h1>

<p class="paragraph">Take information that you want change</p>

<form class="form" method="post">
    <div class="form_to_center" style="margin: 10px">
        <input placeholder="User" class="input_color" name="input_user" style="margin: auto">
        <input placeholder="Row" class="input_color" name="input_row" style="margin: auto">
    </div>
    <div class="form_to_center" style="margin: 10px">
        <input placeholder="Delete" class="input_color" name="input_delete" style="margin: auto">
        <input placeholder="Change" class="input_color" name="input_change" style="margin: auto">
    </div>
    <div class="input_buttons">
        <input class="input_first_button" type="submit" value="Submit" name="submit" />
        <input class="input_second_button" type="reset" value="Reset" name="reset" />
    </div>
</form>

<p class="delete_base_paragraph">Take Surname or Username to delete information</p>

<form class="form" method="post" style="padding: 20px">
    <div class="form_to_center">
        <input placeholder="Username or Surname" class="input_color" name="delete_base" style="margin: auto">
    </div>
    <div class="input_buttons">
        <input class="input_first_button" type="submit" value="Submit" name="submit" style="margin: 10px 0 0 550px" />
    </div>
</form>

<?php

session_start();

$server = 'localhost'; // 127.0.0.1
$user = 'root';
$password = '';
$database = 'SCHOOL_INFO';
$port = 3306;
$table = 'school_registration';

require_once 'school_base_db.php';
$server_connection = mysqli_connect($server, $user, $password, $database);
if (!$server_connection) {
    ?>
    <p class="error_server">
    <?php
    die("Connection failed: " . mysqli_connect_error());
    ?>
    </p>
    <?php
}

$createTable = 'CREATE TABLE IF NOT EXISTS SCHOOL_INFO.school_registration
                (
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    name VARCHAR(50) NOT NULL,
                    surname VARCHAR(130) NOT NULL,
                    telephone VARCHAR(30),
                    city VARCHAR(30) NOT NULL,
                    gender VARCHAR(6) NOT NULL,
                    username VARCHAR(150) NOT NULL,
                    password VARCHAR(150) NOT NULL,
                    email VARCHAR(55) NOT NULL,
                    date VARCHAR(12),
                    level varchar(10)
                )';
$result = $server_connection->query($createTable);

$input_user = null;
$input_row = null;
$input_delete = null;
$input_change = null;
$isGoodDelete = false;

if (isset($_POST['input_user']) && isset($_POST['input_row']) && isset($_POST['input_delete']) && isset($_POST['input_change'])) {
    if (!empty($_POST['input_user']) && !empty($_POST['input_row']) && !empty($_POST['input_delete']) && !empty($_POST['input_change'])) {
        $input_user = $_POST['input_user'];
        $input_row = $_POST['input_row'];
        $input_delete = $_POST['input_delete'];
        $input_change = $_POST['input_change'];
    }
}

if (isset($_POST['input_user']) && !isset($_POST['input_row']) && isset($_POST['input_delete']) && isset($_POST['input_change'])) {
    if (!empty($_POST['input_user']) && !empty($_POST['input_delete'])) {
        $input_user = $_POST['input_user'];
        $input_delete = $_POST['input_delete'];
        $input_change = $_POST['input_change'];
    }
}

if (isset($_POST['input_user']) && isset($_POST['input_row']) && !isset($_POST['input_delete']) && isset($_POST['input_change'])) {
    if (!empty($_POST['input_user']) && !empty($_POST['input_row'])) {
        $input_user = $_POST['input_user'];
        $input_row = $_POST['input_row'];
        $input_change = $_POST['input_change'];
    }
}

if (isset($_POST['input_user']) && isset($_POST['input_row']) && isset($_POST['input_change'])) {
    $input_user = $_POST['input_user'];
    $input_row = $_POST['input_row'];
    $input_delete = $_POST['input_delete'];
    $input_change = $_POST['input_change'];

    // Формируем запрос к серверу
    $query = "SELECT * FROM SCHOOL_INFO.school_registration WHERE surname='$input_user' OR username='$input_user'";

    // Отправляем запрос на сервер
    $result = mysqli_query($server_connection, $query);

    // Проверяем наличие соответствующей строки в таблице
    if (mysqli_num_rows($result) > 0) {
        // Формируем запросы к серверу
        $query_name = "SELECT * FROM SCHOOL_INFO.school_registration WHERE name='$input_delete'";
        $query_surname = "SELECT * FROM SCHOOL_INFO.school_registration WHERE surname='$input_delete'";
        $query_telephone = "SELECT * FROM SCHOOL_INFO.school_registration WHERE telephone='$input_delete'";
        $query_city = "SELECT * FROM SCHOOL_INFO.school_registration WHERE city='$input_delete'";
        $query_gender = "SELECT * FROM SCHOOL_INFO.school_registration WHERE gender='$input_delete'";
        $query_username = "SELECT * FROM SCHOOL_INFO.school_registration WHERE username='$input_delete'";
        $query_password = "SELECT * FROM SCHOOL_INFO.school_registration WHERE password='$input_delete'";
        $query_email = "SELECT * FROM SCHOOL_INFO.school_registration WHERE email='$input_delete'";
        $query_date = "SELECT * FROM SCHOOL_INFO.school_registration WHERE date='$input_delete'";
        $query_level = "SELECT * FROM SCHOOL_INFO.school_registration WHERE level='$input_delete'";

        $query_surname_all = "SELECT * FROM SCHOOL_INFO.school_registration WHERE surname='$input_user'";
        $query_username_all = "SELECT * FROM SCHOOL_INFO.school_registration WHERE username='$input_user'";

        // Отправляем запросы на сервер
        $result_name = mysqli_query($server_connection, $query_name);
        $result_surname = mysqli_query($server_connection, $query_surname);
        $result_telephone = mysqli_query($server_connection, $query_telephone);
        $result_city = mysqli_query($server_connection, $query_city);
        $result_gender = mysqli_query($server_connection, $query_gender);
        $result_username = mysqli_query($server_connection, $query_username);
        $result_password = mysqli_query($server_connection, $query_password);
        $result_email = mysqli_query($server_connection, $query_email);
        $result_date = mysqli_query($server_connection, $query_date);
        $result_level = mysqli_query($server_connection, $query_level);

        $result_surname_all = mysqli_query($server_connection, $query_surname_all);
        $result_username_all = mysqli_query($server_connection, $query_username_all);

        $row_surname_all = mysqli_fetch_assoc($result_surname_all);
        $row_username_all = mysqli_fetch_assoc($result_username_all);

        $row = mysqli_fetch_assoc($result_name);
        print_r($row);
        if ($row['name'] == $input_delete) {
            $query_update = "UPDATE SCHOOL_INFO.school_registration SET name='$input_change' WHERE id={$row['id']}";
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }
        if ($input_row == 'name') {
            if ($row_surname_all['surname'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET name='$input_change' WHERE id={$row_surname_all['id']}";
            }
            if ($row_username_all['username'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET name='$input_change' WHERE id={$row_username_all['id']}";
            }
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }

        $row = mysqli_fetch_assoc($result_username);
        if ($row['surname'] == $input_delete) {
            $query_update = "UPDATE SCHOOL_INFO.school_registration SET surname='$input_change' WHERE id={$row['id']}";
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }
        if ($input_row == 'surname') {
            if ($row_surname_all['surname'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET surname='$input_change' WHERE id={$row_surname_all['id']}";
            }
            if ($row_username_all['username'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET surname='$input_change' WHERE id={$row_username_all['id']}";
            }
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }

        $row = mysqli_fetch_assoc($result_telephone);
        if ($row['telephone'] == $input_delete) {
            $query_update = "UPDATE SCHOOL_INFO.school_registration SET telephone='$input_change' WHERE id={$row['id']}";
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }
        if ($input_row == 'telephone') {
            if ($row_surname_all['surname'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET telephone='$input_change' WHERE id={$row_surname_all['id']}";
            }
            if ($row_username_all['username'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET telephone='$input_change' WHERE id={$row_username_all['id']}";
            }
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }

        $row = mysqli_fetch_assoc($result_city);
        if ($row['city'] == $input_delete) {
            $query_update = "UPDATE SCHOOL_INFO.school_registration SET city='$input_change' WHERE id={$row['id']}";
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }
        if ($input_row == 'city') {
            if ($row_surname_all['surname'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET city='$input_change' WHERE id={$row_surname_all['id']}";
            }
            if ($row_username_all['username'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET city='$input_change' WHERE id={$row_username_all['id']}";
            }
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }

        $row = mysqli_fetch_assoc($result_gender);
        if ($row['gender'] == $input_delete) {
            $query_update = "UPDATE SCHOOL_INFO.school_registration SET gender='$input_change' WHERE id={$row['id']}";
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }
        if ($input_row == 'gender') {
            if ($row_surname_all['surname'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET gender='$input_change' WHERE id={$row_surname_all['id']}";
            }
            if ($row_username_all['username'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET gender='$input_change' WHERE id={$row_username_all['id']}";
            }
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }

        $row = mysqli_fetch_assoc($result_username);
        if ($row['username'] == $input_delete) {
            $query_update = "UPDATE SCHOOL_INFO.school_registration SET username='$input_change' WHERE id={$row['id']}";
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }
        if ($input_row == 'username') {
            if ($row_surname_all['surname'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET username='$input_change' WHERE id={$row_surname_all['id']}";
            }
            if ($row_username_all['username'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET username='$input_change' WHERE id={$row_username_all['id']}";
            }
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }

        $row = mysqli_fetch_assoc($result_password);
        if ($row['password'] == $input_delete) {
            $query_update = "UPDATE SCHOOL_INFO.school_registration SET password='$input_change' WHERE id={$row['id']}";
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }
        if ($input_row == 'password') {
            if ($row_surname_all['surname'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET password='$input_change' WHERE id={$row_surname_all['id']}";
            }
            if ($row_username_all['username'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET password='$input_change' WHERE id={$row_username_all['id']}";
            }
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }

        $row = mysqli_fetch_assoc($result_email);
        if ($row['email'] == $input_delete) {
            $query_update = "UPDATE SCHOOL_INFO.school_registration SET email='$input_change' WHERE id={$row['id']}";
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }
        if ($input_row == 'email') {
            if ($row_surname_all['surname'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET email='$input_change' WHERE id={$row_surname_all['id']}";
            }
            if ($row_username_all['username'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET email='$input_change' WHERE id={$row_username_all['id']}";
            }
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }

        $row = mysqli_fetch_assoc($result_date);
        if ($row['date'] == $input_delete) {
            $query_update = "UPDATE SCHOOL_INFO.school_registration SET date='$input_change' WHERE id={$row['id']}";
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }
        if ($input_row == 'date') {
            if ($row_surname_all['surname'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET date='$input_change' WHERE id={$row_surname_all['id']}";
            }
            if ($row_username_all['username'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET date='$input_change' WHERE id={$row_username_all['id']}";
            }
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }

        $row = mysqli_fetch_assoc($result_level);
        if ($row['level'] == $input_delete) {
            $query_update = "UPDATE SCHOOL_INFO.school_registration SET level='$input_change' WHERE id={$row['id']}";
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }
        if ($input_row == 'level') {
            if ($row_surname_all['surname'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET level='$input_change' WHERE id={$row_surname_all['id']}";
            }
            if ($row_username_all['username'] == $input_user) {
                $query_update = "UPDATE SCHOOL_INFO.school_registration SET level='$input_change' WHERE id={$row_username_all['id']}";
            }
            $isGoodDelete = true;
            mysqli_query($server_connection, $query_update);
        }
        if ($isGoodDelete) {
            ?>
            <p class="good">
                Record deleted successfully
            </p>
            <?php
        }
    }
}

$delete_base = null;
if (isset($_POST['delete_base'])) {
    if (!empty($_POST['delete_base'])) {
        $delete_base = $_POST['delete_base'];

        // Подготавливаем запрос на удаление строки, где поле 'param_name' равно введенному значению
        $sql = "DELETE FROM SCHOOL_INFO.school_registration WHERE username or surname = ?";

// Создаем подготовленное выражение
        $stmt = mysqli_prepare($server_connection, $sql);

// Проверяем, удалось ли создать подготовленное выражение
        if ($stmt) {
            // Связываем параметры с метками
            mysqli_stmt_bind_param($stmt, 's', $delete_base);

            // Выполняем запрос
            mysqli_stmt_execute($stmt);

            // Проверяем количество затронутых строк
            $count = mysqli_stmt_affected_rows($stmt);

            if ($count > 0) {
                ?>
                <p class="good">
                Record deleted successfully
                </p>
                <?php
            } else {
                ?>
                <p class="error">
                There is no record satisfying the condition
                </p>
                <?php
            }

            // Закрываем подготовленное выражение
            mysqli_stmt_close($stmt);
        } else {
            ?>
            <p class="error_server">
            <?php
            echo "Error when creating a prepared expression: " . mysqli_error($server_connection);
            ?>
            </p>
            <?php
        }

        // Сбрасываем значение первичного ключа в таблице БД
        $reset_query = "ALTER TABLE school_registration DROP PRIMARY KEY, ADD PRIMARY KEY(id)";
        $server_connection->query($reset_query);

// Создаём переменную и устанавливаем её значение
        $set_num_query = "SET @num := 0";
        $server_connection->query($set_num_query);

// Обновляем значения первичного ключа в таблице БД
        $update_query = "UPDATE school_registration SET id = @num := (@num + 1)";
        $server_connection->query($update_query);

// Обновляем значение первичного ключа в таблице БД
        $set_primary_key_query = "ALTER TABLE school_registration DROP PRIMARY KEY, ADD PRIMARY KEY(id)";
        $server_connection->query($set_primary_key_query);


        if ($delete_base == 'all' || $delete_base == 'All' || $delete_base == 'ALL') {
                $deleteTable = 'DROP TABLE IF EXISTS SCHOOL_INFO.school_registration';
                $result_drop = $server_connection->query($deleteTable);
                ?>
                <p class="good">All information about users deleted</p>
                <?php
        }
    }
}

$select = 'SELECT * FROM SCHOOL_INFO.school_registration';
//$result_connection = $server_connection->query($select);
$result_connection = mysqli_query($server_connection, $select);

if ($result_connection !== false) {
    $users = $server_connection->query($select)->fetch_all();

    $headers = ['№', 'name', 'surname', 'telephone', 'city', 'gender', 'username', 'password', 'email', 'date', 'level'];
    echo wrapTable($users, $headers);
} else {
    $error_msg = $server_connection->error;
    $error_code = $server_connection->errno;
    ?>
    <p class="error_server">
    <?php
    echo $error_msg . '<br>' . $error_code;
    ?>
    </p>
    <p class="error_server">Something went wrong with server</p>
    <?php
}

mysqli_close($server_connection);

?>
</body>
</html>
