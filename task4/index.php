<?php

function load_users_data($user_ids)
{
    // преобразуем входные данные в массив по разделителю
    $user_ids = explode(',', $user_ids);

    // для удобства даннные для соединения с БД лучше вынести в отдельный файл config.php
    require_once 'config.php';

    // устанавливаем соединение с базой данных
    $db = mysqli_connect($server, $username, $password, $db_name);
    if (mysqli_connect_error()) {
        echo 'Подключение невозможно' . mysqli_connect_error();
    }

    // запрос к БД и получение результата
    foreach ($user_ids as $user_id) {
        $sql = mysqli_query($db, "SELECT * FROM users WHERE id=$user_id");
        while ($obj = $sql->fetch_object()) {
            $data[$user_id] = $obj->name;
        }
    }
    // закрываем соединение с БД
    mysqli_close($db);

    // возвращаем массив с результтатами
    return $data;
}

// Как правило, в $_GET['user_ids'] должна приходить строка
// с номерами пользователей через запятую, например: 1,2,17,48
/*
    Нет проверки значений передаваемых в $_GET на сторонние символы
    уязвимость к SQL injection
*/
$_GET['user_ids'] = '1,2,3,4,5';
$data = load_users_data($_GET['user_ids']);
foreach ($data as $user_id => $name) {
    echo "<a href=\"/show_user.php?id=$user_id\">$name</a><br>";
}
