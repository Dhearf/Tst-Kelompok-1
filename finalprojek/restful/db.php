<?php

define('DB_SERVER', 'localhost'); 
define('DB_USERNAME', 'root');    
define('DB_PASSWORD', '');        
define('DB_NAME', 'poi');        


$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


if ($connection->connect_error) {
    die("Koneksi Gagal: " . $connection->connect_error);
}
?>
