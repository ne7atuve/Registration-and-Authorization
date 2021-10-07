<?php

session_start();
require "functions.php";


$email = $_POST["email"];
$password = $_POST["password"];

$user = get_user_by_email($email);

if(!empty($user))
{
	if(password_verify($password, $user["password"]) === true)
	{
		$_SESSION["auth"] = true;
		$_SESSION["user"] = 
		[
			"id" => $user["id"],
			"email" => $user["email"],
			"password" => $user["password"]
		];
		redirect_to("/Регистрация/users.php");
	}
	else
	{
		set_flash_message("danger", "Пароль введен неверно!");
		redirect_to("/Регистрация/page_login.php");
	}
}
else
{
	set_flash_message("danger", "Данный пользователь не существует");
	redirect_to("/Регистрация/page_login.php");
}







?>