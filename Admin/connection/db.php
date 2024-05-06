<?php
define("HOST","127.0.0.1");
define("USER","root");
define("PASS","");
define("DB_NAME","toy-shop");
function create_connection()
{
    $conn=new mysqli(HOST, USER, PASS, DB_NAME);
    if ($conn->connect_error) {
        die("can not connect". $conn->connect_error);
    }
    return $conn;
}
$conn=create_connection();

?>