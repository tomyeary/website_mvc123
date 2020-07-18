<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/cart.php';  ?>
<?php include '../classes/brand.php';  ?> 
<?php include '../classes/product.php';  ?>
<?php require_once '../helpers/format.php'; ?>
<?php 
	$pd = new product();
	$fm = new Format();
	if(!isset($_GET['productid']) || $_GET['productid'] == NULL){
        // echo "<script> window.location = 'catlist.php' </script>";
        
    }else {
        $id = $_GET['productid']; // Lấy catid trên host
        $delProduct = $pd -> del_product($id); // hàm check delete Name khi submit lên
    }
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Quản lý kho</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Code</th>
<<<<<<< HEAD
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Product Soldout</th>		
					<th>Product remaint</th>
					<th>Quantity Add</th>
					<th>Behind Import</th>
					<th>Date import</th>
=======
					<th>Tên sản phẩm</th>
				
					<th>Số lượng ban đầu</th>
					<th>Đã bán</th>
				
					<th>Số lượng trước nhập</th>
					<th>Số lượng thêm</th>
					<th>Số lượng sau nhập</th>
					
					<th>Ngày nhập</th>
>>>>>>> 9f5e4997a43fb38c32ac9580a584fe56bf0d1c4c

					
					
				</tr>
			</thead>
			<tbody>
				<?php 
				
				$pdlist = $pd->show_product_warehouse();
				$i = 0;
				
				
					if($pdlist){
					
							while ($result = $pdlist->fetch_assoc()){
								$i++;
									
									
				 ?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['product_code'] ?></td>
<<<<<<< HEAD
					<td><?php echo $result['productName'] ?></td>
=======
					
>>>>>>> 9f5e4997a43fb38c32ac9580a584fe56bf0d1c4c
					<td>
						<?php echo $result['quantity'] ?>

					</td>
					<td>
						<?php echo $result['product_soldout'] ?>

					</td>
<<<<<<< HEAD
					<td>
						<?php echo $result['product_remain'] ?>

					</td>
					
=======
					
					<td>
						<?php echo $result['product_remain'] - $result['sl_nhap'] ?>

					</td>
>>>>>>> 9f5e4997a43fb38c32ac9580a584fe56bf0d1c4c
					<td>
						<?php echo $result['sl_nhap'] ?>

					</td>
<<<<<<< HEAD
					
					
					<td>
						<?php echo $result['product_remain'] - $result['sl_nhap'] ?>
=======
					<td>
						<?php echo $result['product_remain'] ?>
>>>>>>> 9f5e4997a43fb38c32ac9580a584fe56bf0d1c4c

					</td>
					<td>
						<?php echo $result['sl_ngaynhap'] ?>

					</td>
<<<<<<< HEAD
					
=======
					<td><?php echo $result['productName'] ?></td>
>>>>>>> 9f5e4997a43fb38c32ac9580a584fe56bf0d1c4c
					
					
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
