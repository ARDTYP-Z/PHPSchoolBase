<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="school_base.css">
    <link rel="stylesheet" type="text/css" href="school_base_registration.css">
</head>
<h1>Hello, it is registration part</h1>

<p class="paragraph">
    You can put down information about yourself <br>
    and registration will be done
</p>

<form method="post" action="" class="form">
    <br>
    <div class="form_to_center">
        <div class="form_left">
            <input placeholder="Name" title="Input your name" type="text" name="name" class="input_color" maxlength="50" formnovalidate tabindex="1" />
            <br>
            <input placeholder="Surname" type="text" name="surname" class="input_color" maxlength="130" formnovalidate tabindex="2" />
            <br>
            <input placeholder="Telephone" type="tel" name="telephone" class="input_color" maxlength="30" tabindex="3">
            <br>
            <input placeholder="City" type="text" name="city" class="input_color" maxlength="30" tabindex="4" />
            <br>
            <select name="gender" id="gender" class="input" tabindex="5" onchange="this.classList.toggle('input_color', this.value === 'Male' || this.value === 'Female');">
                <option value="" selected disabled hidden>Gender</option>
                <option value="Male" class="input_color">Male</option>
                <option value="Female" class="input_color">Female</option>
            </select>
            <br>
        </div>
        <div class="form_right">
            <input placeholder="Username" type="text" name="username" class="input_color" maxlength="150" formnovalidate tabindex="6" />
            <br>
            <input placeholder="Password" type="password" name="password" class="input_color" maxlength="150" tabindex="7" />
            <br>
            <input placeholder="Email" type="email" name="email" class="input_color" maxlength="55" formnovalidate tabindex="8" />
            <br>
            <input placeholder="Date of birthday" name="date" class="input" maxlength="12" tabindex="9" style="color: gray;"
                   min="1900-01-01" max="2022-12-31"
                   onfocus="this.style.color='#fad0a0'; if(this.type =='text') this.value=''; this.type='date';"
                   onblur="this.style.color='#fad0a0'; if(!this.value) {this.type='text'; this.value='Date of birth';}">
            <br>
            <select name="level" id="level" class="input" tabindex="10" onchange="this.classList.toggle('input_color', this.value === 'Student' || this.value === 'Teacher' || this.value === 'Director');">
                <option value="" selected disabled hidden>Level</option>
                <option value="Student" class="input_color">Student</option>
                <option value="Teacher" class="input_color">Teacher</option>
                <option value="Director" class="input_color">Director</option>
            </select>
            <br>
        </div>
    </div>
    <br>
    <div class="input_buttons">
        <input type="submit" value="Submit" class="input_first_button" />
        <input type="reset" value="Reset" class="input_second_button" onclick="location.reload(); document.querySelector('input[type=date]').style.color = ''; document.getElementById('gender').className='input'" />
        <input type="button" value="Log in" class="input_third_button" onclick="window.location.href = 'school_base_authorization.php';">
    </div>
</form>
<?php
$name_input = null;
$surname_input = null;
$telephone_input = null;
$city_input = null;
$gender_input = null;
$username_input = null;
$password_input = null;
$email_input = null;
$date_input = null;
$level_input = null;

if (isset($_POST['name']) ||
    isset($_POST['surname']) ||
    isset($_POST['telephone']) ||
    isset($_POST['city']) ||
    isset($_POST['gender']) ||
    isset($_POST['username']) ||
    isset($_POST['password']) ||
    isset($_POST['email']) ||
    isset($_POST['date']) ||
    isset($_POST['level'])) {

    if (isset($_POST['gender']) && isset($_POST['level'])) {
        $name_input = $_POST['name'];
        $surname_input = $_POST['surname'];
        $telephone_input = $_POST['telephone'];
        $city_input = $_POST['city'];
        $gender_input = $_POST['gender'];
        $username_input = $_POST['username'];
        $password_input = $_POST['password'];
        $email_input = $_POST['email'];
        $date_input = $_POST['date'];
        $level_input = $_POST['level'];
    }
    else {
        $name_input = $_POST['name'];
        $surname_input = $_POST['surname'];
        $telephone_input = $_POST['telephone'];
        $city_input = $_POST['city'];
        $gender_input = '';
        $username_input = $_POST['username'];
        $password_input = $_POST['password'];
        $email_input = $_POST['email'];
        $date_input = $_POST['date'];
        $level_input = '';
    }
}

$server = 'localhost'; // 127.0.0.1
$user = 'root';
$password = '';
$database = 'SCHOOL_INFO';
$port = 3306;
$table = 'school_registration';

require_once 'school_base_db.php';
$server_connection = mysqli_connect($server, $user, $password, $database);

//$deleteTable = 'DROP TABLE IF EXISTS SCHOOL_INFO.school_registration';
//$result_drop = $server_connection->query($deleteTable);

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
if (mysqli_query($server_connection, $createTable)) {
    //nothing
} else {
    echo "Error creating table: " . mysqli_error($server_connection);
}
$result = $server_connection->query($createTable);

$select = 'SELECT * FROM SCHOOL_INFO.school_registration';
//$result_connection = $server_connection->query($select);
$result_connection = mysqli_query($server_connection, $select);

if ($result_connection !== false) {
    $usernames_base = $server_connection->query('SELECT username FROM SCHOOL_INFO.school_registration')->fetch_all();
    $surnames_base = $server_connection->query('SELECT surname FROM SCHOOL_INFO.school_registration')->fetch_all();

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username_input = $_POST['username'];
        $password_input = $_POST['password'];
        $surname_input = $_POST['surname'];

        if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['surname'])) {

            $isLogin = false;
            foreach ($usernames_base as $item) {
                foreach ($item as $username_base) {
                    if ($username_input !== $username_base) {
                        $isLogin = true;
                    } else {
                        $isLogin = false;
                        ?>
                        <p class="error">User with this username is already exist</p>
                        <?php
                    }
                }
            }

            $isSurname = false;
            foreach ($surnames_base as $item) {
                foreach ($item as $surname_base) {
                    if ($surname_input !== $surname_base) {
                        $isSurname = true;
                    } else {
                        $isSurname = false;
                        ?>
                        <p class="error">User with this surname is already exist</p>
                        <?php
                    }
                }
            }

            // Проверяем длину пароля
            $isLeng = true;
            if (strlen($password_input) < 8 || strlen($password_input) > 20) {
                ?>
                    <p class="error">Invalid length of your password</p>
                <?php
                $isLeng = false;
            }

            // Проверяем, что пароль содержит только английские буквы и цифры
            $isEng = true;
            if (!preg_match('/^[a-zA-Z0-9]+$/', $password_input)) {
                    ?>
                    <p class="error">Only English letters</p>
                    <?php
                    $isEng =  false;
                }

            // Проверяем, что в пароле есть хотя бы одна строчная буква
            $isLowLet = true;
            if (!preg_match('/[a-z]+/', $password_input)) {
                    ?>
                    <p class="error">No lowercase letter in your password</p>
                    <?php
                    $isLowLet =  false;
                }

                // Проверяем, что в пароле есть хотя бы одна заглавная буква
                $isUpLet = true;
                if (!preg_match('/[A-Z]+/', $password_input)) {
                        ?>
                        <p class="error">No capital letter in your password </p>
                        <?php
                        $isUpLet =  false;

                }

                    // Проверяем, что в пароле есть хотя бы одна цифра
                $isNum = true;
                if (!preg_match('/\d+/', $password_input)) {
                    ?>
                    <p class="error">No numbers in your password</p>
                    <?php
                    $isNum =  false;
                }
        } else {
            ?>
            <p class="error">Username, password or surname are empty</p>
            <?php
            $isSurname = false;
            $isLogin = false;
            $isLeng = false;
            $isEng = false;
            $isLowLet = false;
            $isUpLet = false;
            $isNum = false;
        }


            if ($isSurname && $isLogin && $isLeng && $isEng && $isLowLet && $isUpLet && $isNum) {
                ?>
                <p class="good">Good registration</p>
                <?php
                try {
                    // Подключение к базе данных
                    $db = new PDO("mysql:host=$server;dbname=$database", $user, $password);
                    // Устанавливаем корректную кодировку
                    $db->exec("set names utf8");
                    // Собираем данные для запроса
                    $data = array( 'name' =>  $name_input,
                        'surname' => $surname_input,
                        'telephone' => $telephone_input,
                        'city' => $city_input,
                        'gender' => $gender_input,
                        'username' => $username_input,
                        'password' => $password_input,
                        'email' => $email_input,
                        'date' => $date_input,
                        'level' => $level_input);
                    // Подготавливаем SQL-запрос
                    $query = $db->prepare("INSERT INTO $table (name, surname, telephone, city, gender, username, password, email, date, level) 
                                            values (:name, :surname, :telephone, :city, :gender, :username, :password, :email, :date, :level)");
                    // Выполняем запрос с данными
                    if ($name_input != null || $surname_input != null || $telephone_input != null || $city_input != null || $gender_input != null || $username_input != null ||
                        $password_input != null || $email_input != null || $date_input != null || $level_input != null) {

                        $query->execute($data);
                    }

//                    $users = $server_connection->query($select)->fetch_all();
//
//                    $headers = ['№', 'name', 'surname', 'telephone', 'city', 'gender', 'username', 'password', 'email', 'date', 'level'];
//                    echo wrapTable($users, $headers);

                    $result_con = true;
                } catch (PDOException $e) {
                    // Если есть ошибка соединения, выводим её
                    print "Ошибка!: " . $e->getMessage() . "<br/>";
                }
                if (!$result_con) {
                    echo "Провал. Информация не занесена в базу данных";
                }

            } else {
                ?>
                <p class="paragraph">Take your information one time more</p>
                <?php
            }
    }
} else {
    $error_msg = $server_connection->error;
    $error_code = $server_connection->errno;
    echo $error_msg . '<br>' . $error_code;
    ?>
    <p class="error_server">Something went wrong with server</p>
    <?php
}

$users = $server_connection->query($select)->fetch_all();

$file = fopen('school_base_users_info.txt', 'w');
fwrite($file, serialize($users));
fclose($file);

mysqli_close($server_connection);
exit();

?>
</body>
</html>
