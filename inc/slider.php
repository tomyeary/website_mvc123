<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">

				<?php 
					$getLastestSamsung = $product->getLastestSamsung();
					if($getLastestSamsung)
					{
						while ($resultsamsung = $getLastestSamsung->fetch_assoc()) {
				 ?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.html"> <img src="admin/uploads/<?php echo $resultsamsung['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>SamSung</h2>
						<p><?php echo $resultsamsung['productName'] ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultsamsung['productId']?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php 
			   		}
			   	}
			    ?>	

			    <?php 
					$getLastestApple = $product->getLastestApple();
					if($getLastestApple)
					{
						while ($resultapple = $getLastestApple->fetch_assoc()) {
				 ?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview.html"><img src="admin/uploads/<?php echo $resultapple['image'] ?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Apple</h2>
						  <p><?php echo $resultapple['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultapple['productId']?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php 
					}
				}
				 ?>
			</div>
			<div class="section group">
				 <?php 
					$getLastestDell = $product->getLastestDell();
					if($getLastestDell)
					{
						while ($resultdell = $getLastestDell->fetch_assoc()) {
				 ?>	
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.html"> <img src="admin/uploads/<?php echo $resultdell['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Dell</h2>
						<p><?php echo $resultdell['productName'] ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultdell['productId']?>">Add to cart</a></span></div>
				   </div>
				   <?php 
				   	}
				   }
				    ?>
			   </div>	
			   <?php 
					$getLastestXiaomi = $product->getLastestXiaomi();
					if($getLastestXiaomi)
					{
						while ($resultxiaomi = $getLastestXiaomi->fetch_assoc()) {
				 ?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview.html"><img src="admin/uploads/<?php echo $resultxiaomi['image'] ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Xiaomi</h2>
						  <p><?php echo $resultxiaomi['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultxiaomi['productId']?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php 
					}
				}
				 ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php 
							$get_slider= $product->show_slider();
							if ($get_slider) {
								while ($result_slider = $get_slider->fetch_assoc()) {
									
								
							
						 ?>
						<li><img src="admin/uploads/<?php echo $result_slider['slider_image'] ?>" alt=""/></li>
						<?php 
						}
					} ?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>