<?php  
	// debug($_SESSION);
	// debug($_COOKIE);


	if (!isset($_SESSION, $_SESSION['token']) || empty($_SESSION['token'])) 
	{
		if (isset($_COOKIE, $_COOKIE['_au']) && !empty($_COOKIE['_au'])) 
		{
			$user = new User();
			$token = $_COOKIE['_au'];

			$user_info = $user->getUserByToken($token);

			if (!$user_info) 
			{
				setcookie('_au', '', time()-60,'/');
				redirect('./','error','Please login first. ');
			}

				$_SESSION['user_id'] = $user_info[0]->id;
				$_SESSION['name'] = $user_info[0]->name;
				$_SESSION['email'] = $user_info[0]->email;
				$_SESSION['role'] = $user_info[0]->role;
				$token = generateRandomString(100);
				$data = array
				(
					'last_ip' => $_SERVER['REMOTE_ADDR'],
					'last_login' => date('Y-m-d H:i:s')

				);

				setcookie('_au',$token,time()+864000,'/');
				$data['remember_token'] = $token;
				$_SESSION['token'] = $token;
				$user->updateUser($data, $user_info[0]->id);

				//debug($user_info);
		}
		else
		{
			redirect('./');
		}

	}




?>