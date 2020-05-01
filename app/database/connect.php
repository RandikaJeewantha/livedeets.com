<?php

    $host = "localhost";
    $user = 'root';
    $pass = '';
    $db_name = 'livedeets.com';

    $conn = new MySQLI($host, $user, $pass, $db_name);

    if($conn -> connect_error) {
        die("Database Connection Error: " . $connect_error);
    }
?>