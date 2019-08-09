<?php 
	class User extends Database
	 {
	 	public function __construct()
	 	{
	 		parent::__construct();
	 		$this->table('users');
	 	}
	
		public function getUserByUserName($email)
		{
			$args = array 
			(
				//'fields' => ['id', 'name', 'email', 'password', 'role', 'status']
				//'fields' => 'id, name, email, password, role, status'
				//'where' => "email = '".$email."'" 

				'where' => array 
				(
					'email' => $email,
					'status' => 'active'

				)

			);

			return $this->select($args);

		}

		public function getUserByToken($token)
		{
			$args = array 
			(   
				'where' => array 
				(
					'remember_token' => $token
				),

			);

			return $this->select($args);

		}

		public function updateUser($data, $user_id)
		{
			$args = array('where' => array 
			(
				'id' => $user_id
			));

			$success = $this->update($data, $args);
			if ($success)
			{
				return $user_id;
			}
			else
			{
				return false;
			}
		}
	}


 ?>