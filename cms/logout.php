<?php
    require $_SERVER['DOCUMENT_ROOT'].'/staff_details/config/init.php';

    if(isset($_COOKIE, $_COOKIE['_au']))
    {
        setcookie('_au','', time()-60, '/');
    }
    $data = array(
        'remember_token' => ''
    );
    $user = new User;
    $user_id = $_SESSION['user_id'];

    $user->updateUser($data, $user_id);

    session_destroy();

    redirect('./');
?>