<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

 
<?php
	

	class brand 
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		//thêm danh mục sản phẩm
		public function insert_brand($brandName)
		{
			$brandName = $this->fm->validation($brandName);

			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			
				
			if (empty($brandName)){
				$alert = "<span class='error'>Brand must be not empty</span>";
				return $alert;
			}else{
				$query = "	INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Insert brand successfully</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Insert brand not success</span>";
					return $alert;	
				}
			}
		}

		// show danh mục sản phẩm
		public function show_brand()
		{
			$query = "SELECT * FROM tbl_brand order by brandId desc ";
			$result = $this->db->select($query);
			return $result;
		}


		//lấy id
		public function getbrandbyId($id)
		{
			$query = "SELECT * FROM tbl_brand where brandId = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}


		//cập nhập sản phẩm
		public function update_brand($brandName, $id)
		{
			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if (empty($brandName)){
				$alert = "<span class='error'>Brand must be not empty</span>";
				return $alert;
			}else{
				$query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId ='$id'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Updated brand successfully</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Updated brand not success</span>";
					return $alert;	
				}
			}
		}

		public function del_brand($id)
		{
			$query = "DELETE FROM tbl_brand WHERE brandId = '$id' ";
			$result = $this->db->delete($query);
			if($result){
					$alert = "<span class='success'> Brand deleted successfully </span>";
					return $alert;
				}else{
					$alert = "<span class='error'> Brand deleted not success </span>";
					return $alert;	
				}
		}
	}
 ?>