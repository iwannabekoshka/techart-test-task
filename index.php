<?php

// Отображение ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключение файлов системы
define('ROOT', dirname(__FILE__)); // Корень файловой системы
require_once(ROOT . '/components/Router.php');
require_once(ROOT . '/components/Database.php');
require_once(ROOT . '/components/ErrorHandler.php');

// Вызов Router
$router = new Router();
$router->run();