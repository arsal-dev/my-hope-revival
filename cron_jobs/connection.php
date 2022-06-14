<?php
use App\Config;
date_default_timezone_set ("Asia/Karachi");
$db_host = Config::DB_HOST;
$db_user = Config::DB_USER;
$db_pass = Config::DB_PASSWORD;
$db_name = Config::DB_NAME;
try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
} catch (PDOException $e) {
}