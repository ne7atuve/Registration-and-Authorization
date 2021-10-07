<?php

function get_user_by_email($email)
{
	$pdo = new PDO("mysql:host=array;dbname=registration;", "root", "");

$sql = "SELECT * FROM my_register WHERE email=:email";
$statement = $pdo->prepare($sql);
$statement->execute(["email" => $email]);
$user = $statement->fetch(PDO::FETCH_ASSOC);
return $user;
}

function add_user($email, $password)
{
	$pdo = new PDO("mysql:host=array;dbname=registration;", "root", "");
	$sql = "INSERT INTO my_register (email, password) VALUES (:email, :password)";

$pwd = password_hash($password, PASSWORD_DEFAULT);

$statement = $pdo->prepare($sql);
$result = $statement->execute(["email" => $email, "password" => $pwd]);

return $pdo->lastInsertId();
}

function set_flash_message($name, $message)
{
	$_SESSION[$name] = $message;
}

function redirect_to($path)
{
	header("Location: {$path}");
	exit;
}

function display_flash_message($name)
{
	if(isset($_SESSION[$name]))
	{
		echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\"> {$_SESSION[$name]}</div>";
		unset($_SESSION[$name]);
	}
}



?>