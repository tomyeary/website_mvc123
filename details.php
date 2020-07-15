<?php
	include 'inc/header.php';
	
?>
<?php
	if(!isset($_GET['proid']) || $_GET['proid']==NULL)
	    {
	        echo "<script>window.location = '404.php'</script>";
	    }else
	    {
	        $id = $_GET['proid'];
	    }
	$customer_id = Session::get('customer_id');
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['compare']))
    {
    	$productid = $_POST['productid'];
        $insertCompare = $product->insertCompare($productid,$customer_id);
    }

     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['wishlist']))
    {
    	$productid = $_POST['productid'];
        $insertWishlist = $product->insertWishlist($productid,$customer_id);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['submit']))
    {
    	$quantity = $_POST['quantity'];
        $AddtoCart = $ct->add_to_cart($quantity,$id);
    }
    if (isset($_POST['binhluan_submit'])) {
    	$binhluan_insert = $cs->insert_binhluan();
    }
  ?>

  
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php 
    			$get_product_details = $product->get_details($id);
    			if($get_product_details){
    				while ($result_details = $get_product_details->fetch_assoc()) {
    					
    				
    		 ?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_details['productName'] ?></h2>
					<p><?php echo $fm->textShorten($result_details['product_desc'],100) ?></p>					
					<div class="price">
						<p>Price: <span><?php echo $fm->format_currency($result_details['price'])." "."VNĐ" ?></span></p>
						<p>Category: <span><?php echo $result_details['catName'] ?></span></p>
						<p>Brand:<span><?php echo $result_details['brandName'] ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
						
					</form>	
						<?php 
							if(isset($AddtoCart))
							{
								echo '<span style="color:red; font-size:18px;">Product Already Added</span>';
							}
						 ?>	
				</div>

				<div class="add-cart">
					<div class="button_details">
					<form action="" method="POST">
						<!-- <a class="buysubmit" href="?wlist=<?php echo $result_details['productId'] ?>">Save to Favoritel List</a>
						<a class="buysubmit" href="?compare=<?php echo $result_details['productId'] ?>">Compare Product</a> -->
						<input type="hidden" name="productid" value="<?php echo $result_details['productId'] ?>"/>
						

						<?php 
							$check_login = Session::get('customer_login');
							if($check_login )
								{
									echo '<input type="submit" name="compare" class="buysubmit" value="Compare Product"/>'.' ';
									
								}
								else
								{
									echo '';
								}
 						?>	
 						
						</form>

						<form action="" method="POST">
						<!-- <a class="buysubmit" href="?wlist=<?php echo $result_details['productId'] ?>">Save to Favoritel List</a>
						<a class="buysubmit" href="?compare=<?php echo $result_details['productId'] ?>">Compare Product</a> -->
						<input type="hidden" name="productid" value="<?php echo $result_details['productId'] ?>"/>
						

						<?php 
							$check_login = Session::get('customer_login');
							if($check_login )
								{
									
									echo '<input type="submit" name="wishlist" class="buysubmit" value="Save to wishlist"/>';
								}
								else
								{
									echo '';
								}
 						?>	
 						
						</form>
						</div>
						<div class="clear"></div>
						<p>
						<?php 
							if (isset($insertCompare)) {
								echo $insertCompare;
							}
						 ?>
						 </p>
						 <p>
						 <?php 
							if (isset($insertWishlist)) {
								echo $insertWishlist;
							}
						 ?>
						 </p>
						
				</div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $fm->textShorten($result_details['product_desc'],100) ?></p>
	    </div>
				
	</div>
	<?php 
		}
	}
	 ?>
	
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
				      <?php 
				      	$getall_category = $cat->show_category_fontend();
				      	if ($getall_category) {

				      		while ($result_allcat = $getall_category->fetch_assoc()) {

				       ?>
				       <li><a href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?>"><?php echo $result_allcat['catName'] ?></a></li>
				       <?php 
				       	}
				       }
				        ?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
 	<!-- <div class="binhluan">
 		<div class="row">
 			<div class="col-md-8">
		 		<h5>Ý kiến sản phẩm</h5>
		 		<?php 
		 			if (isset($binhluan_insert)) {
		 				echo $binhluan_insert;
		 			}
		 		 ?>
		 		<form action="" method="POST">
		 			<p><input type="hidden" value="<?php echo $id ?>" name="product_id_binhluan"></p>
			 		<p><input type="text" placeholder="Điền tên" class="form-control" name="tennguoibinhluan"></p>
			 		<p><textarea rows="7" style="resize: none;" placeholder="Bình luận" class="form-control" name="binhluan"></textarea></p>
			 		<p><input type="submit" name="binhluan_submit" class="btn btn-success" value="Gửi bình luận"></p>
		 		</form>
 			</div>
 		</div>
</textarea>
 -->
	<div class="fb-comments" data-href="http://localhost:81/website_mvc" data-numposts="5" data-width=""></div>
</div>
	</div>

<?php
	include 'inc/footer.php';
?>
