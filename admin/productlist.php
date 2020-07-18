﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>
<?php 
	$pd = new product();
	$fm = new Format();
	if (isset($_GET['productid']))
	{
		$id = $_GET['productid'];
		$delpro = $pd->del_product($id);
	}
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Code</th>
					<th>Product Name</th>
					<th>Import</th>
					<th>Quantity</th>
					<th>Product Soldout</th>
					<th>Product Remaint</th>
					<th>Product Price</th>
					<th>Product Image</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Descriptipn</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					
					$pdlist = $pd -> show_product();
					if($pdlist){
						$i = 0;
						while ($result = $pdlist->fetch_assoc()) {
							$i++;
						
				 ?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['product_code'] ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><a href="productmorequantity.php?productid=<?php echo $result['productId'] ?>">Nhập hàng</a></td>
					<td><?php echo $result['quantity'] ?></td>
					<td><?php echo $result['product_soldout'] ?></td>
					<td><?php echo $result['product_remain'] ?></td>
					<td><?php echo $result['price'] ?></td>
					<td><img src="uploads/<?php echo $result['image'] ?>"width="50"></td>
					<td><?php echo $result['catName'] ?></td>
					<td><?php echo $result['brandName'] ?></td>
					<td><?php 

						echo $fm ->textShorten($result['product_desc'], 10) ?></td>
						
					<td><?php 
						if($result['type']==0)
						{
							echo 'Feathered';
						}else{
							echo 'Non-Feathered'; 
						}
					 ?></td>
					
					<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Edit</a> || <a href="?productid=<?php echo $result['productId'] ?>">Delete</a></td>
				</tr>
				<?php 
			}
					}
				 ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
