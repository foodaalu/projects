<?php 
		
	require_once $_SERVER['DOCUMENT_ROOT'].'/staff_details/config/config.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/staff_details/config/functions.php';

	spl_autoload_register(function($class_name)
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/staff_details/class/'.$class_name.".php";
	});

 ?>