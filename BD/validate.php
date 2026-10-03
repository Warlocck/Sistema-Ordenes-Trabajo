<?php
include('config.php');
session_start();
//recepción de datos enviados mediante POST desde ajax
$username = (isset($_POST['username'])) ? $_POST['username'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
// $username = $_POST['username'];
// $password = $_POST['password'];

$username=$mysqli->real_escape_string($username);
$query="CALL ValidarEjecutivo('$username','$password')";

$result=$mysqli->query($query);
if($result->num_rows==1)
{
    $_SESSION['user']=$username;
}
else
{
    $data=null;
}
print json_encode($data);
$conexion=null;
?>