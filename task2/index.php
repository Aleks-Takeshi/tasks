<?php

$url = 'https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3';

function removeURL($url)
{
    $parsed = parse_url($url);
    parse_str($parsed['query'], $query);

    // удаляем лишние значения из параметров
    foreach ($query as $key => $value) {
        if (substr($value, -1) == 3) {
            unset($query[$key]);
        }
    }

    // сортируем параметры по значению
    asort($query);

    // добавляем путь в параметры
    $query['url'] = $parsed['path'];

    // формируем валидный url
    return $parsed['scheme'] . '://' . $parsed['host'] . '/?' . http_build_query($query);
}

echo removeURL($url);
