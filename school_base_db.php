<?php // db.php

// Создать функию dbconnect возвращающую объект подключения к mysql (mysqli)
// Установить кодировку utf8mb4 перед возвратом

// Проверить наличие ошибки подключения, при наличии ошибки завершить выполнение скрипта и вывести сообщение на страницу

function dbconnect($database, $table)
{
    $server = 'localhost'; // 127.0.0.1
    $user = 'root';
    $password = '';
    $database;
    $port = 3306;
    $table;

    // Подключение к серверу mysql
    $mysqli = new mysqli($server, $user, $password, $database, $port);
    if ($mysqli->connect_errno) {
        /* Используйте предпочитаемый вами метод регистрации ошибок */
        die('Ошибка соединения: ' . $mysqli->connect_errno);
    }
    /* изменение кодировки на utf8mb4 */
    $mysqli->set_charset("utf8mb4");

    return $mysqli;
}

function wrapTable($tableArray, $tableHeaders = null)
{
    $table = '<table class="table">';

    if ($tableHeaders != null) {


        $table .= "<thead>";

        $table .= wrapRowHeader($tableHeaders);

        $table .= "</thead>";

    }
    $table .= "<tbody>";

    foreach ($tableArray as $row) {
        $table .= wrapRow($row);
    }

    $table .= "</tbody>";
    $table .= "</table>";

    return $table;
}

function wrapRow($row)
{
    $tr = "<tr>";

    foreach ($row as $cell) {
        $tr .= "<td>$cell</td>";
    }

    $tr .= "</tr>";

    return $tr;
}

function wrapRowHeader($row)
{
    $tr = "<tr>";

    foreach ($row as $cell) {
        $tr .= "<th>$cell</th>";
    }

    $tr .= "</tr>";

    return $tr;
}
