<?php

require 'func.php';

// Login
if(isset($_POST['login']))
{
   
    header('Content-Type: application/json');

    $data = getUser($_POST['u']);

    if(password_verify($_POST['p'], $data->password))
    {
        // If Login Success, Then Create Session
        $_SESSION['l'] = $data->name;
        // Update Login Time
        insertTimestamp($data->name);

        print json_encode([
            "name" => $data->name,
            "username" => $data->username,
            'login_time' => getTimestamp($data->name)
        ]);
    }
    else
    {
        print json_encode(["status" => null]);
    }

}

// Register
if(isset($_POST['register']))
{
   
    header('Content-Type: application/json');

    $data = regUser($_POST);

    print json_encode(["status" => "Success"]);

}
