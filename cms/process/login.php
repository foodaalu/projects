<?php 
	
	require $_SERVER['DOCUMENT_ROOT'].'/staff_details/config/init.php';
	$user = new User();
	if(isset($_POST) && !empty($_POST)) 
	{
		//debug($_POST);

		$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

		if (!$email) 
		{
			redirect('../','error','Inavalid email format');
		}

		$password = sha1($email.$_POST['password']);

		$user_info = $user->getUserByUserName($email);
		if (!$user_info) 
		{
			redirect('../','error','Unreconized username.');
		}
		else
		{
			if ($user_info[0]->password == $password) 
			{
				if ($user_info[0]->role == 'admin' || $user_info[0]->role == 'editor') 
				{
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
					if (isset($_POST['remember']) && !empty($_POST['remember'])) 
					{
						setcookie('_au',$token,time()+864000,'/');
						$data['remember_token'] = $token;

					}

					$_SESSION['token'] = $token;

					$user->updateUser($data, $user_info[0]->id);
					redirect('../dashboard.php','success','Welcom to admin panel');
					//debug($_POST);
				}
				else
				{
					redirect('../','error','You are not authorized access this page');
				}
			}
			else
			{
				redirect('../','error','Password dose not match');
			}
		}
	}
	else
	{
		redirect('../','error','You are not authorized to access this page'); 
	}
	




 ?>