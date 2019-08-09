<?php  

	ob_start();
	session_start();

	define('SITE_URL', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']);
	
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'staff_details');


	define('ADMIN_URL', SITE_URL.'/cms');

	define('ERROR_LOG', $_SERVER['DOCUMENT_ROOT'].'/staff_details/error/error.log');


	define('ALLOWED_EXTENSION', array('jpg','jpeg','png','gif','bmp'));

    define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/staff_details/uploads');
    
    define('UPLOAD_URL', SITE_URL.'/uploads');


	define('ADMIN_ASSETS', ADMIN_URL.'/assets');
	define('ADMIN_CSS', ADMIN_ASSETS.'/css');
	define('ADMIN_JS', ADMIN_ASSETS.'/js');

?>