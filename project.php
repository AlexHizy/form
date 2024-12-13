<?php

// Данные отправляются методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверка, что поля не пустые
    if (isset($_POST['surname'])) {
        $surname = trim($_POST['surname']);
    } else {
        $surname = null;  // присваиваем пустое значение, если строка не заполнена. Нужно для сл скрипта на проверку пустой строки.
    }

    if (isset($_POST['firstName'])) {
        $firstName = trim($_POST['firstName']);
    } else {
        $firstName = null;  
    }

    if (isset($_POST['patronymic'])) {
        $patronymic = trim($_POST['patronymic']);
    } else {
        $patronymic = null;  
    }
    
    
    // Сообщение, если поля не все заполнены - используем функцию
    if (empty($surname) || empty($firstName) || empty($patronymic)) {
        echo "<p>Пожалуйста, заполните все поля.</p>";
        exit;
    }
    
    // Использовал mbstring, т.к. без него кирилца не получалась в инициалах и абривиатре
    $fullName = mb_convert_case($surname, MB_CASE_TITLE, "UTF-8") . ' ' .
                mb_convert_case($firstName, MB_CASE_TITLE, "UTF-8") . ' ' .
                mb_convert_case($patronymic, MB_CASE_TITLE, "UTF-8");

    // Аббревиатура
    $fio = mb_strtoupper(mb_substr($surname, 0, 1, "UTF-8")) .
           mb_strtoupper(mb_substr($firstName, 0, 1, "UTF-8")) .
           mb_strtoupper(mb_substr($patronymic, 0, 1, "UTF-8"));
    
    // Фамилия и инициалы 
    $surnameAndInitials = mb_convert_case($surname, MB_CASE_TITLE, "UTF-8") . ' ' .
                          mb_strtoupper(mb_substr($firstName, 0, 1, "UTF-8")) . '.' .
                          mb_strtoupper(mb_substr($patronymic, 0, 1, "UTF-8")) . '.';
    
    // Вывод 
    echo "<h1>Результаты обработки данных</h1>";
    echo "<p><strong>Полное имя:</strong> $fullName</p>";
    echo "<p><strong>Фамилия и инициалы:</strong> $surnameAndInitials</p>";
    echo "<p><strong>Аббревиатура (ФИО):</strong> $fio</p>";
}
?>