<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once	 ($filepath.'/../lib/session.php');
	Session::checkLogin();
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
 ?> 
<?php
	/**
	 * 
	 */
	class adminlogin 
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		/*public function admin_changepassword($matkhaucu,$matkhaumoi)
		{
			$matkhaucu = $this ->fm ->validation($matkhaucu); 	
			$matkhaumoi = $this ->fm ->validation($matkhaumoi); 
			$matkhaucu = mysqli_real_escape_string($this->db->link, $matkhaucu);
			$matkhaumoi = mysqli_real_escape_string($this->db->link, $matkhaumoi);
			$query = "SELECT * FROM tbl_admin WHERE adminPass = '$matkhaucu' LIMIT 1";
			$result = $this->db->select($query);
			$get_rows = mysqli_num_rows($query);
			if ($get_rows == 0) 
			{

				echo '<script>
						  alert("Sai tài khoản hoặc mật khẩu xin hãy điển lại!")
						</script>';
			}else
			{
				$capnhap = "UPDATE tbl_admin set adminPass = '$matkhaumoi'";
				$result = $this->db->select($capnhap);
				echo '<script>
						  alert("Bạn đã thay đổi mật khẩu!");
						</script>';
			}
		}
			*/
				
				
			


		public function login_admin($adminUser,$adminPass)
		{
			$adminUser = $this ->fm ->validation($adminUser); 	
			$adminPass = $this ->fm ->validation($adminPass); 

			$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
			$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

			if (empty($adminUser) || empty($adminPass))
			{
				$alert = "User And Password must be not empty";
				return $alert;
			}
			else 
			{
				$query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
				$result = $this->db->select($query);

				if ($result != false)
				{
					$value = $result->fetch_assoc();

					Session::set('adminlogin', true);

					Session::set('adminId',$value['adminId']);
					Session::set('adminUser',$value['adminUser']);
					Session::set('adminName',$value['adminName']);
					header('Location:index.php');
				}
				else
				{
					$alert = "User and Pass not match";
					return $alert;
				} 

			}
		}

	}
 ?>