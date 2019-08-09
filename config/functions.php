<?php 

		function debug($data, $is_exit = false)
		{
			echo "<pre>";
			print_r($data);
			echo "</pre>";

			if ($is_exit) 
			{
				exit;
			}
		}


		function setFlash($key, $msg)
		{
			if (!isset($_SESSION)) 
			{
				session_start();
			}

			$_SESSION[$key] = $msg;
		}
		
		function redirect($path, $msg_key = null, $msg = null)
		{
			if ($msg_key !== null) 
			{
				setFlash($msg_key, $msg);
			}
			header('location: '.$path);
			exit;
		}

		function flash()
		{
			if (isset($_SESSION['success']) && !empty($_SESSION['success'])) 
			{
				echo '<p class="alert alert-success">'.$_SESSION['success'].'</p>';
				unset($_SESSION['success']);
			}

			if (isset($_SESSION['error']) && !empty($_SESSION['error'])) 
			{
				echo '<p class="alert alert-danger">'.$_SESSION['error'].'</p>';
				unset($_SESSION['error']);
			}

			if (isset($_SESSION['warning']) && !empty($_SESSION['warning'])) 
			{
				echo '<p class="alert alert-warning">'.$_SESSION['warning'].'</p>';
				unset($_SESSION['warning']);
			}
		}

		function generateRandomString($length =100)
		{
			$chars = "069751654134651bcvgfidkhvcijfb";
			$len = strlen($chars);
			$random = "";
			for($i=0; $i<$length; $i++) 
			{
				$posn = rand(0, $len-1);
				$random .= $chars[$posn];
			}
			return $random;
		}

		function sanitize($str)
		{
			$str = strip_tags($str);
			$str = rtrim($str);
			return $str;
		}

		function uploadSingleImage($file, $dir)
		{
			if ($file['error'] == 0)
			{
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);

				if (in_array(strtolower($ext), ALLOWED_EXTENSION)) 
				{
					if ($file['size'] <= 3000000) 
					{
						$path = UPLOAD_DIR.'/'.$dir;

						if (!is_dir($path)) 
						{
							mkdir($path, 0777, true);
						}

						$file_name = ucfirst($dir)."-".date('Ymdhis').rand(0,999).".".$ext;
						$success = move_uploaded_file($file['tmp_name'], $path."/".$file_name);
						if ($success) 
						{
							return $file_name;
						}
						else
						{
							return null;
						}
					}
					else
					{
						return null;
					}
				}
				else
				{
					return null;
				}
			}
			else
			{
				return null; 
			}
		}

 ?>