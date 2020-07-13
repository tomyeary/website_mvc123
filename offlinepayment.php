<?php
	include 'inc/header.php';
	
?>
<?php
	if(isset($_GET['orderid']) && $_GET['orderid']=='order')
	    {
	        $customer_id = Session::get('customer_id');
	        $insertOrder = $ct->insertOrder($customer_id);
	        $delcart = $ct->del_all_data_cart(); 
	        header('Location:success.php');
	    }
   
  ?>
  <style type="text/css">

  	
  	.box_left
  	{
  		width:50%;
  		
  		float: left;
  		padding: 10px;
  	}
  	.box_right
  	{
  		width: 46%;
  		
  		float: right;
  		padding: 10px
  	}
  	.a_order
  	{
  		background: #4B088A;
  		padding: 7px 20px;
  		color: #fff;
  		font-size: 21px;
  		border-radius: 5px
  	}
  </style>
  <form action="" method="POST">
 <div class="main">

    <div class="content">
    	<div class="section group">
    	<div class="heading">
	    			<h3>Offline Payment </h3>
	    		</div>
	    		<div class="clear"></div>
	    		<div class="box_left">
	    			<div class="cartpage">

				<?php 
					if(isset($update_quantity_cart))
					{
						echo $update_quantity_cart;
					}
				 ?>
				 <?php 
				 	if(isset($delcart))
					{
						echo $delcart;
					}
				  ?>
						<table class="tblone">
							<tr>
								<th width="20%">ID</th>
								<th width="20%">Product Name</th>	
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								
							</tr>
							<?php 
								$get_product_cart = $ct->get_product_cart(); 
								if($get_product_cart){
									$suptotal = 0;
									$qty = 0;
									$i = 0;
									while($result = $get_product_cart->fetch_assoc()){
										$i++;

							 ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								
								<td><?php echo $result['price'].' '.'VNĐ' ?></td>
								<td>
									
										
										<?php echo $result['quantity'] ?>
									
								</td>
								<td><?php 
									$tolal = $result['price'] * $result['quantity'];
									echo $tolal.' '.'VNĐ';	
								 ?></td>
								
							</tr>
							
							<?php 
							$suptotal += $tolal;
							$qty = $qty + $result['quantity'];
								}
							}
							 ?>
							
						</table>
						<?php 
										$check_cart = $ct->check_cart();
										if($check_cart){
										
									 ?>
						<table style="float:right;text-align:left;   margin: 4px" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php 
									
									echo $suptotal.' '.'VNĐ';	
									Session::set('sum', $suptotal);		
									Session::set('qty', $qty);					
								 ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td> 10% (<?php echo $vat = $suptotal * 0.1; ?>)</td>
							</tr>
							<tr>
								<th>Total Quantity:</th>
								<td><?php 
									$vat = $suptotal * 0.1;
									$gtotal = $suptotal + $vat;
									echo $gtotal.' '.'VNĐ';
								 ?> </td>
							</tr>
							
					   </table>
					   <?php 
					   	}else
					   	{
					   		echo 'Your cart is empty! Pls shopping now';
					   	}

					    ?>
					</div></div>
	    		<div class="box_right"><table class="tblone">
    				<?php 
	    				$id = Session::get('customer_id');
	    				$get_customers = $cs->show_customers($id);
	    				if($get_customers){
	    						while ($result = $get_customers->fetch_assoc()){
    				 ?>
    				<tr>
    					<td>Name:</td>
    					<td>:</td>
    					<td><?php echo $result['name'] ?></td>
    				</tr>
    				<tr>
    					<td>City:</td>
    					<td>:</td>
    					<td><?php echo $result['city'] ?></td>
    				</tr>		
    				<tr>
    					<td>Phone:</td>
    					<td>:</td>
    					<td><?php echo $result['phone'] ?></td>
    				</tr>	
    				
    				<tr>
    					<td>Zipcode:</td>
    					<td>:</td>
    					<td><?php echo $result['zipcode'] ?></td>
    				</tr>	
    				<tr>
    					<td>Email:</td>
    					<td>:</td>
    					<td><?php echo $result['email'] ?></td>
    				</tr>	
    				<tr>
    					<td>Address:</td>
    					<td>:</td>
    					<td><?php echo $result['address'] ?></td>
    				</tr>
                      
                    <?php
    					}
    				}
    				 ?>
    			</table>
    		</div>
    		
 	</div>
 	<center><a href="?orderid=order" class="a_order">Order Now</a></center>
</div>
</div>
</form>

<?php
	include 'inc/footer.php';
?>
