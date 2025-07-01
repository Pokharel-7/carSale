<?php
    $host = "localhost:3306";
    $user = "root";
    $pass = "";
    $dbname = "web_lab";

    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        die(" DB connection failed: " . $conn->connect_error);
    }
?>