<?php
	define("APP_ROOT", "$_SERVER[HTTP_HOST]/warrantyservice");
	date_default_timezone_set('Asia/Dhaka');
	if(session_status() == PHP_SESSION_NONE) session_start();
	if(isset(array_keys($_GET)[0])){
		$path = array_keys($_GET)[0];
		$controller = $path;
		if(!isset($_SESSION['shopKeeper'])) 
		{
			if($controller != "login" && $controller != "signup")
			{
				$controller = "login";
			}
		}
	}
	else
	{
		if(isset($_SESSION['shopKeeper'])) 
		{
			$controller="home";
		}
		else $controller = "login";
	}
	
    require_once "app/controller/$controller"."_controller.php";
?>