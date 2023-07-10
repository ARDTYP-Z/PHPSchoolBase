<!
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher</title>
    <link rel="stylesheet" type="text/css" href="school_base.css">
    <link rel="stylesheet" type="text/css" href="school_base_teacher.css">

</head>
<body>

<h1>Your level is Teacher</h1>
<h2 class="h2">Hear you can see information about students</h2>
<h3 class="h3">Students : </h3>

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

$select = 'SELECT * FROM SCHOOL_INFO.school_registration WHERE level = "Student"';
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

?>

</body>
</html>