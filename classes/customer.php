<?php
		$filepath = realpath(dirname(__FILE__));
		 include_once ($filepath.'/../lib/database.php');
		 include_once ($filepath.'/../helpers/format.php');
 ?>

 
<?php
	

	class customer
	{

		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_binhluan()
		{
			$product_id =   $_POST['product_id_binhluan'];
			$tenbinhluan = $_POST['tennguoibinhluan'];
			$binhluan = $_POST['binhluan'];
			if ($tenbinhluan==''||$binhluan=='') 
			{
				$alert = "<span class='error'>Fiels must be not empty</span>";
				return $alert;
			}else
			{
				$query = "INSERT INTO tbl_comment(tenbinhluan, binhluan, product_id) VALUES('$tenbinhluan','$binhluan','$product_id')";
					$result = $this->db->insert($query);
						if($result)
						{
							$alert = "<span class='success'>The comment has been approved</span>";
							return $alert;
						}else
						{
							$alert = "<span class='success'>The comment has't been approved</span>";
							return $alert;
						}
			}
		}
		public function  insert_customers($data)
		{
			$name = mysqli_real_escape_string($this->db->link,$data['name']);
			$city	 = mysqli_real_escape_string($this->db->link,$data['city']);
			$zipcode = mysqli_real_escape_string($this->db->link,$data['zipcode']);
			$email = mysqli_real_escape_string($this->db->link,$data['email']);
			$address = mysqli_real_escape_string($this->db->link,$data['address']);
			$country = mysqli_real_escape_string($this->db->link,$data['country']);
			$phone = mysqli_real_escape_string($this->db->link,$data['phone']);
			$password = mysqli_real_escape_string($this->db->link,md5($data['password']));
			if ($name == "" ||$city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == ""){
				$alert = "<span class='error'>Fiels must be not empty</span>";
				return $alert;
			}
			else{
				$check_mail = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1 ";
				$result_check = $this->db->select($check_mail);
				if($result_check)
				{
					$alert = "<span class='error'>Email Already Existed</span>";
					return $alert;
				}
				else
				{
					$query = "	INSERT INTO tbl_customer(name,city,zipcode,email,address,country,phone,password) VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$password')";
					$result = $this->db->insert($query);
						if($result){
						$alert = "<span class='success'>Customer Created Successfully</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Customer Created Not Success</span>";
						return $alert;	
					}
				}
			}
		}

		public function login_customers($data)
		{
			$email = mysqli_real_escape_string($this->db->link,$data['email']);
			$password = mysqli_real_escape_string($this->db->link,md5($data['password']));
			if ( $email == "" || $password == ""){
				$alert = "<span class='error'>Password And Email Be Not Empty</span>";
				return $alert;
			}
			else{
				$check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'  ";
				$result_check = $this->db->select($check_login);
				if($result_check)
				{
					$values = $result_check->fetch_assoc();
					Session::set('customer_login',true);
					Session::set('customer_id',$values['id']);
					Session::set('customer_name',$values['name']);
					header('Location:order.php');

				}
				else
				{				
					$alert = "<span class='error'>Email or Password doesn't match</span>";
					return $alert;
				}
			}
		}
		public function show_customers($id)
		{
			$query = "SELECT * FROM tbl_customer WHERE id='$id' ";
			$result = $this->db->select($query);
			return $result;
		}	

		public function update_customers($data,$id)
		{
			$name = mysqli_real_escape_string($this->db->link,$data['name']);
			$zipcode = mysqli_real_escape_string($this->db->link,$data['zipcode']);
			$email = mysqli_real_escape_string($this->db->link,$data['email']);
			$address = mysqli_real_escape_string($this->db->link,$data['address']);
			$phone = mysqli_real_escape_string($this->db->link,$data['phone']);
			
			if ($name == ""  || $zipcode == "" || $email == "" || $address == "" || $phone == "" ){
				$alert = "<span class='error'>Fiels must be not empty</span>";
				return $alert;
			}
			else{
				
				
					$query = "	UPDATE  tbl_customer SET name = '$name',zipcode = '$zipcode',email = '$email',address = '$address',phone = '$phone' WHERE id = '$id'";
					$result = $this->db->update($query);
						if($result){
						$alert = "<span class='success'>Customer Updated Successfully</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Customer Updated Not Success</span>";
						return $alert;	
					}
				
			}
		}
		
	}
?>
 