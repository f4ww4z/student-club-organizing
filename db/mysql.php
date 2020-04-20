<?php
function get_connection(): mysqli
{
    // Username: iqOcXwtS5W
    // Database name: iqOcXwtS5W
    // Password: qRZFqLKD6s
    // Server: remotemysql.com
    $username = "iqOcXwtS5W";
    $database = "iqOcXwtS5W";
    $password = "qRZFqLKD6s";
    $host = "remotemysql.com";
    $port = "3306";

    return mysqli_connect($host, $username, $password, $database, $port);
}