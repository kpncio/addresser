<?php

function odb()
{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $data = "ip2location";
    $conn = new mysqli($host, $user, $pass,$data) or die("Connect failed: %s\n". $conn -> error);

    return $conn;
}

function cdb($conn)
{
    $conn -> close();
}