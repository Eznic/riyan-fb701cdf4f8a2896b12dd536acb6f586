<?php

// DB
$host = 'localhost';
$user = "root";
$pass = "";
$dbName = "mkm";

$con = mysqli_connect($host, $user, $pass, $dbName);

if( ! $con )
{
    die("Something Wrong In Database Connection");
}

// Get Data
function getData($query)
{
    global $con;
    $datas = [];

    $result = mysqli_query($con, $query);
    
    while($data = mysqli_fetch_object($result))
    {
        $datas[] = $data; 
    }

    return $datas;
}

// Get User
function getUser($username)
{

    $q = "SELECT * FROM user WHERE username = '$username'";
    $result = getData($q);

    return $result != null ? $result[0] : null;
    
}

// Reg User
function regUser($data)
{
    global $con;
    $n = $data['n'];
    $u = strtolower($data['u']);
    $p = password_hash($data['p'], PASSWORD_DEFAULT);

    $q = "INSERT INTO user(name,username,password,login_time) VALUES('{$n}', '{$u}', '{$p}', CURRENT_TIMESTAMP())";
    
    mysqli_query($con, $q);
    
}

function insertTimestamp($name)
{
    global $con;

    $q = "UPDATE user SET login_time = CURRENT_TIMESTAMP() WHERE name = '$name'";
    
    mysqli_query($con, $q);
    
}

function getTimestamp($name)
{
    return getData("SELECT login_time FROM user WHERE name = '$name'")[0]->login_time;
}

