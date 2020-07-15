<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

 
<?php
	

	class product 
	{

		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		//thêm danh mục sản phẩm
		public function insert_product($data, $files)
		{
			

			$productName = mysqli_real_escape_string($this->db->link,$data['productName']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			// kiem tra hinh anh va lay hinh anh cho vao folder upload
			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			
				
			if ($productName == "" ||$brand == "" || $category == ""  || $product_desc == "" || $price == "" || $type == "" || $file_name == ""){
				$alert = "<span class='error'>Fiels must be not empty</span>";
				return $alert;
			}else{
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "	INSERT INTO tbl_product(productName,brandId,catId,product_desc,price,type,image) VALUES('$productName','$brand','$category','$product_desc','$price','$type','$unique_image')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Insert product successfully</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Insert product not success</span>";
					return $alert;	
				}
			}
		}

		 
		public function show_product()
		{
			$query = "SELECT tbl_product.*,tbl_category.catName, tbl_brand.brandName
			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
			INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
			order by tbl_product.productId desc";

			/*$query = "SELECT * FROM tbl_product order by productId desc ";*/
			$result = $this->db->select($query);
			return $result;
		}


		//lấy id
		public function getproductbyId($id)
		{
			$query = "SELECT * FROM tbl_product where productId = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}


		//cập nhập sản phẩm
		public function update_product($data,$files, $id)
		{
			
			$productName = mysqli_real_escape_string($this->db->link,$data['productName']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			// kiem tra hinh anh va lay hinh anh cho vao folder upload
			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;


			if ($productName == "" ||$brand == "" || $category == ""  || $product_desc == "" || $price == "" || $type == ""){
				$alert = "<span class='error'>category must be not empty</span>";
				return $alert;
			}else
			{
				if (!empty($file_name))
				{
					//nếu người dùng không chọn anh
					if ($file_size > 725270 ) 
					{
						
						$alert = "<span class='success'>Image size should be less then 2MB!</span";
						return $alert;
					}
					elseif (in_array($file_ext, $permited) === false) 
					{
						
						$alert = "<span class='success'>you can upload only:-".implode(',', $permited)."</span";
						return $alert;
					}
					$query = "UPDATE tbl_product SET 
					productName = '$productName',
					brandId = '$brand',
					catId = '$category',
					type = '$type',
					price = '$price',
					image = '$unique_image',
					product_desc = '$product_desc'
					WHERE productId = '$id'";

				}
				//nếu người dùng không chọn ảnh
				else
				{
					$query = "UPDATE tbl_product SET
					productName = '$productName',
					brandId = '$brand',
					catId = '$category',
					type = '$type',
					price = '$price',	
					product_desc = '$product_desc'
					WHERE productId = '$id'";
				}
			

				
				$result = $this->db->update($query);
				if($result)
				{
					$alert = "<span class='success'>Product update successfully</span>";
					return $alert;
				}else
				{
					$alert = "<span class='error'>Product update not success</span>";
					return $alert;	
				}
			}
		}

		public function del_product($id)
		{
			$query = "DELETE FROM tbl_product WHERE productId = '$id' ";
			$result = $this->db->delete($query);
			if($result){
					$alert = "<span class='success'> Product deleted successfully </span>";
					return $alert;
				}else{
					$alert = "<span class='error'> Product deleted not success </span>";
					return $alert;	
				}
		}
		public function getproduct_feathered()
		{
			$query = "SELECT * FROM tbl_product where type = '0' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function getproduct_new()
		{
			$sp_tungtrang = 4;
			if (!isset($_GET['trang'])) {
				$trang =1 ;
			}else{
				$trang = $_GET['trang'];
			}
			$tung_trang = ($trang -1 ) * $sp_tungtrang;
			$query = "SELECT * FROM tbl_product order by productId desc LIMIT $tung_trang, $sp_tungtrang  ";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_all_product()
		{
			$query = "SELECT * FROM tbl_product   ";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_details($id)
		{
			$query = "SELECT tbl_product.*,tbl_category.catName, tbl_brand.brandName
			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
			INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId where tbl_product.productId = '$id'
			 ";

			
			$result = $this->db->select($query);
			return $result;
		}

		public function getLastestDell()
		{
			$query = "SELECT * FROM tbl_product  WHERE brandId = '2' order by productId desc LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestSamsung()
		{
			$query = "SELECT * FROM tbl_product  WHERE brandId = '3' order by productId desc LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestApple()
		{
			$query = "SELECT * FROM tbl_product  WHERE brandId = '5' order by productId desc LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestXiaomi()
		{
			$query = "SELECT * FROM tbl_product  WHERE brandId = '6' order by productId desc LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		}

		public function insertCompare($productid,$customer_id)
		{
			
			
			$productid = mysqli_real_escape_string($this->db->link,$productid);
			$customer_id = mysqli_real_escape_string($this->db->link,$customer_id);
			
			$check_compare = "SELECT * FROM tbl_compare where productId = '$productid' AND customer_id = '$customer_id'";
			$result_check_compare = $this->db->select($check_compare);
			if ($result_check_compare) 
			{
				$msg  = "<span class='error'>Product Already Added to Compare</span>";
				return $msg;
			}
			else
			{

				$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
				$result = $this->db->select($query)->fetch_assoc();

				$productName = $result["productName"];
				$price = $result["price"];
				$image = $result['image'];
			
				
				
				
					$query_insert = "INSERT INTO tbl_compare(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
					$insert_compare= $this->db->insert($query_insert);
					if($insert_compare)
					{
						$alert = "<span class='success'>Added Compare successfully</span>";
						return $alert;
					}else
					{
						$alert = "<span class='success'>Added Compare not successfully</span>";
						return $alert;
					}
			}
		}

		public function get_compare($customer_id)
		{
			$query = "SELECT * FROM tbl_compare  WHERE customer_id = '$customer_id' order by id desc  ";
			$result = $this->db->select($query);
			return $result;
		}

		public function insertWishlist($productid,$customer_id)
		{
			$productid = mysqli_real_escape_string($this->db->link,$productid);
			$customer_id = mysqli_real_escape_string($this->db->link,$customer_id);
			
			$check_wishlist = "SELECT * FROM tbl_wishlist where productId = '$productid' AND customer_id = '$customer_id'";
			$result_check_wishlist = $this->db->select($check_wishlist);
			if ($result_check_wishlist) 
			{
				$msg  = "<span class='error'>Product Already Added to Wishlist</span>";
				return $msg;
			}
			else
			{

				$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
				$result = $this->db->select($query)->fetch_assoc();

				$productName = $result["productName"];
				$price = $result["price"];
				$image = $result['image'];
			
				
				
				
					$query_insert = "INSERT INTO tbl_wishlist(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
					$insert_wishlist= $this->db->insert($query_insert);
					if($insert_wishlist)
					{
						$alert = "<span class='success'>Added Wishlist successfully</span>";
						return $alert;
					}else
					{
						$alert = "<span class='success'>Added Wishlist not successfully</span>";
						return $alert;
					}
			}
		}

		public function get_wishlist($customer_id)
		{
			$query = "SELECT * FROM tbl_wishlist  WHERE customer_id = '$customer_id' order by id desc  ";
			$result = $this->db->select($query);
			return $result;
		}

		public function del_wishlist($proid, $customer_id)
		{
			$query = "DELETE FROM tbl_wishlist WHERE productId = '$proid' AND customer_id = '$customer_id' ";
			$result = $this->db->delete($query);
			return $result;
			
		}


		public function insert_slider($data, $files)
		{
			$sliderName = mysqli_real_escape_string($this->db->link,$data['sliderName']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			
			// kiem tra hinh anh va lay hinh anh cho vao folder upload
			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;


			if ($sliderName == "" ||$type == "" ){
				$alert = "<span class='error'>Fields be not empty</span>";
				return $alert;
			}else
			{
				if (!empty($file_name))
				{
					//n?u ngư?i dùng không ch?n anh
					if ($file_size > 725270) 
					{
						
						$alert = "<span class='success'>Image size should be less then 2MB!</span";
						return $alert;
					}
					elseif (in_array($file_ext, $permited) === false) 
					{
						
						$alert = "<span class='success'>you can upload only:-".implode(',', $permited)."</span";
						return $alert;
					}
					move_uploaded_file($file_temp, $uploaded_image);

					$query = "	INSERT INTO tbl_slider(sliderName,type,slider_image) VALUES('$sliderName','$type','$unique_image')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Insert Slider Added Successfully</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Insert Slider Added not success</span>";
						return $alert;	
					}
				}
				
			}
		}

		public function show_slider()
		{
			$query = "SELECT * FROM tbl_slider where type='1' order by sliderId desc ";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_type_slider($id, $type)
		{
			$type = mysqli_real_escape_string($this->db->link,$type);
			$query = "UPDATE tbl_slider SET type ='$type' where sliderId = '$id' ";
			$result = $this->db->update($query);
			return $result;
		}

		public function show_slider_list()
		{
			$query = "SELECT * FROM tbl_slider order by sliderId desc ";
			$result = $this->db->select($query);
			return $result;
		}

		public function del_slider($id)
		{
			$query = "DELETE FROM tbl_slider WHERE sliderId = '$id' ";
			$result = $this->db->delete($query);
			if($result){
					$alert = "<span class='success'> Slider deleted successfully </span>";
					return $alert;
				}else{
					$alert = "<span class='error'> Sli deleted not success </span>";
					return $alert;	
				}
		}

	}

 ?>