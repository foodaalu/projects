<?php 
	require $_SERVER['DOCUMENT_ROOT'].'/staff_details/config/init.php';
	include '../inc/checklogin.php'; 

	$usermanagement = new Usermanagement();

	if (isset($_POST) && !empty($_POST)) 
	{
		// debug($_POST);
		// debug($_FILES);

		$data = array 
		(
			'first_name' => sanitize($_POST['first_name']),
			'middle_name' => sanitize($_POST['middle_name']),
			'last_name' => sanitize($_POST['last_name']),
			'father_name' => sanitize($_POST['father_name']),
			'mother_name' => sanitize($_POST['mother_name']),
			'email' => sanitize($_POST['email']),
			'status' => sanitize($_POST['status']),
			'phone_no' => sanitize($_POST['phone_no']),
			'address' => sanitize($_POST['address']),
			'gender' => sanitize($_POST['gender']),
			'role_type' => sanitize($_POST['role_type']),
			'description' => sanitize($_POST['description']),
			'salary' => sanitize($_POST['salary']),
			'reporting' => sanitize($_POST['reporting']),
			'performance' => sanitize($_POST['performance']),
			'added_by' => $_SESSION['user_id']
		);

		if (isset($_FILES, $_FILES['image']) && $_FILES['image']['error'] == 0)
		{
			$file_name = uploadSingleImage($_FILES['image'], 'usermanagement');
			if ($file_name)
			{
				$data['image'] = $file_name;
			}
		}

		$staff_id = $usermanagement->addUser($data);

		if ($staff_id) 
		{
			redirect('../usermanagement.php','success','Staff Added Successfully.');
		}
		else
		{
			redirect('../usermanagement.php','error','Sorry! There was problem while adding staff.');
		}
	}
	else 
	{
		redirect('../usermanagement.php','error','Unauthorized access.');
	}




 ?>