<!
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student</title>
    <link rel="stylesheet" type="text/css" href="school_base.css">
    <link rel="stylesheet" type="text/css" href="school_base_student.css">

</head>
<p>

<h1>Your level is Student</h1>
<h2>Hear you can see information about yourself</h2>

<?php
$server = 'localhost'; // 127.0.0.1
$user = 'root';
$password = '';
$database = 'SCHOOL_INFO';
$port = 3306;
$table = 'school_registration';

require_once 'school_base_db.php';
$server_connection = mysqli_connect($server, $user, $password, $database);
if (!$server_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
$username = $_SESSION['username'];

if (!empty($username)) {
    $query_name = "SELECT name FROM SCHOOL_INFO.school_registration WHERE username = '$username'";
    $result_name = mysqli_query($server_connection, $query_name);
    $row_name = mysqli_fetch_assoc($result_name);
    $base_name = $row_name['name'];
    ?>
    <div class="form_to_center">
    <p class="form_left">
        <label class="information_left">
            <?php
            echo 'Name: ' . $base_name . '<br>';
            ?>
        </label>
        <?php

        $query_surname = "SELECT surname FROM SCHOOL_INFO.school_registration WHERE username = '$username'";
        $result_surname = mysqli_query($server_connection, $query_surname);
        $row_surname = mysqli_fetch_assoc($result_surname);
        $base_surname = $row_surname['surname'];
        ?>
        <label class="information_left">
            <?php
            echo 'Surname: ' . $base_surname . '<br>';
            ?>
        </label>
        <?php

        $query_telephone = "SELECT telephone FROM SCHOOL_INFO.school_registration WHERE username = '$username'";
        $result_telephone = mysqli_query($server_connection, $query_telephone);
        $row_telephone = mysqli_fetch_assoc($result_telephone);
        $base_telephone = $row_telephone['telephone'];
        ?>
        <label class="information_left">
            <?php
            echo 'Telephone: ' . $base_telephone . '<br>';
            ?>
        </label>
        <?php

        $query_city = "SELECT city FROM SCHOOL_INFO.school_registration WHERE username = '$username'";
        $result_city = mysqli_query($server_connection, $query_city);
        $row_city = mysqli_fetch_assoc($result_city);
        $base_city = $row_city['city'];
        ?>
        <label class="information_left">
            <?php
            echo 'City: ' . $base_city . '<br>';
            ?>
        </label>
        <?php

        $query_gender = "SELECT gender FROM SCHOOL_INFO.school_registration WHERE username = '$username'";
        $result_gender = mysqli_query($server_connection, $query_gender);
        $row_gender = mysqli_fetch_assoc($result_gender);
        $base_gender = $row_gender['gender'];
        ?>
        <label class="information_left">
            <?php
            echo 'Gender: ' . $base_gender . '<br>';
            ?>
        </label>
    </p>
    <?php
        $query_username = "SELECT username FROM SCHOOL_INFO.school_registration WHERE username = '$username'";
        $result_username = mysqli_query($server_connection, $query_username);
        $row_username = mysqli_fetch_assoc($result_username);
        $base_username = $row_username['username'];
    ?>
    <p class="form_right">
        <label class="information_right">
            <?php
            echo 'Username: ' . $base_username . '<br>';
            ?>
        </label>
        <?php

        $query_password = "SELECT password FROM SCHOOL_INFO.school_registration WHERE username = '$username'";
        $result_password = mysqli_query($server_connection, $query_password);
        $row_password = mysqli_fetch_assoc($result_password);
        $base_password = $row_password['password'];
        ?>
        <label class="information_right">
            <?php
            echo 'Password: ' . $base_password . '<br>';
            ?>
        </label>
        <?php

        $query_email = "SELECT email FROM SCHOOL_INFO.school_registration WHERE username = '$username'";
        $result_email = mysqli_query($server_connection, $query_email);
        $row_email = mysqli_fetch_assoc($result_email);
        $base_email = $row_email['email'];
        ?>
        <label class="information_right">
            <?php
            echo 'Email: ' . $base_email . '<br>';
            ?>
        </label>
        <?php

        $query_date = "SELECT date FROM SCHOOL_INFO.school_registration WHERE username = '$username'";
        $result_date = mysqli_query($server_connection, $query_date);
        $row_date = mysqli_fetch_assoc($result_date);
        $base_date = $row_date['date'];
        ?>
        <label class="information_right">
            <?php
            echo 'Date: ' . $base_date . '<br>';
            ?>
        </label>
        <?php

        $query_level = "SELECT level FROM SCHOOL_INFO.school_registration WHERE username = '$username'";
        $result_level = mysqli_query($server_connection, $query_level);
        $row_level = mysqli_fetch_assoc($result_level);
        $base_level = $row_level['level'];
        ?>
        <label class="information_right">
            <?php
            echo 'Level: ' . $base_level . '<br>';
            ?>
        </label>
    </p>
    </div>
    <?php
}
?>

</html>
