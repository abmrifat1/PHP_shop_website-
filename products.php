<?php require_once("inc/header.php"); ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Iphone</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
				<?php 
                 $getIphone = $pd->getIponeAll();
                 if($getIphone){
					 while($iPhone = $getIphone->fetch_array()){
                    extract($iPhone);
                ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?=$productId;?>"> <img src="admin/upload/<?= $image; ?>" alt="" style="height:150px;"/></a>
					 <h2><?=$productName;?></h2>
					 <p><span class="price"><?=$price;?> $</span></p>
				     <div class="button"><span><a href="details.php?proId=<?=$productId;?>" class="details">Details</a></span></div>
				</div>
				 <?php } }?>
			</div>
			
			<div class="content_bottom">
				<div class="heading">
					<h3>Latest from Acer</h3>
				</div>
				<div class="clear"></div>
			</div>
			<div class="section group">
				<?php 
                 $getAcer = $pd->getAcerAll();
                 if($getAcer){
					 while($acer = $getAcer->fetch_array()){
                    extract($acer);
                ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?=$productId;?>"> <img src="admin/upload/<?= $image; ?>" alt="" style="height:150px;"/></a>
					 <h2><?=$productName;?></h2>
					 <p><span class="price"><?=$price;?> $</span></p>
				     <div class="button"><span><a href="details.php?proId=<?=$productId;?>" class="details">Details</a></span></div>
				</div>
				 <?php } }?>
			</div>
			<div class="content_bottom">
				<div class="heading">
					<h3>Latest from Cannon</h3>
				</div>
				<div class="clear"></div>
			</div>
			<div class="section group">
				<?php 
                 $getCanon = $pd->getCanonAll();
                 if($getCanon){
					 while($Canon = $getCanon->fetch_array()){
                    extract($Canon);
                ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?=$productId;?>"> <img src="admin/upload/<?= $image; ?>" alt="" style="height:150px;"/></a>
					 <h2><?=$productName;?></h2>
					 <p><span class="price"><?=$price;?> $</span></p>
				     <div class="button"><span><a href="details.php?proId=<?=$productId;?>" class="details">Details</a></span></div>
				</div>
				 <?php } }?>
			</div>
			<div class="content_bottom">
				<div class="heading">
					<h3>Latest from Samsung</h3>
				</div>
				<div class="clear"></div>
			</div>
			<div class="section group">
				<?php 
                 $getSamsung = $pd->getSamsungAll();
                 if($getSamsung){
					 while($Samsung = $getSamsung->fetch_array()){
                    extract($Samsung);
                ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?=$productId;?>"> <img src="admin/upload/<?= $image; ?>" alt="" style="height:150px;"/></a>
					 <h2><?=$productName;?></h2>
					 <p><span class="price"><?=$price;?> $</span></p>
				     <div class="button"><span><a href="details.php?proId=<?=$productId;?>" class="details">Details</a></span></div>
				</div>
				 <?php } }?>
			</div>
			
    </div>
     <div class="footer-image">
         <img src="images/brands.PNG" style="width:100%;height:400px"/>
     </div>
 </div>
<?php require_once("inc/footer.php"); ?>