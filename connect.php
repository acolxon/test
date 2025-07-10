<?php
    $localhost = "localhost";
    $dbname = "p-347186_test";
    $login = "p-347186_asylkhan";
    $pass = "asylkhan04";
    $charset = "utf8mb4";

    $dsn = "mysql:host=$localhost;dbname=$dbname;charset=$charset";

    try {
        $pdo = new PDO($dsn, $login, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Ошибки — через исключения
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // По умолчанию массивы
            PDO::ATTR_EMULATE_PREPARES => false, // Настоящие prepare-запросы
        ]);
    } catch (PDOException $e) {
        die("Ошибка подключения к базе: " . $e->getMessage()); // Показывать только в dev!
    }
?>
