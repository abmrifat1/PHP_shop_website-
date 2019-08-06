<?php require_once("inc/header.php"); ?>
<?php
	if(!isset($_POST['searchValue']) && $_POST['searchValue'] == NULL){
        header("Location:index.php");
    }else{
		$searchValue= $_POST['searchValue'];
	}
?>
 <div class="main">
    <div class="content">
		<?php 
			 $getProduct = $pd->searchProductAll($searchValue);
			 if($getProduct){?>
	      <div class="section group">
				<?php
					 while($product = $getProduct->fetch_array()){
                    extract($product);
                ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?=$productId;?>"> <img src="admin/upload/<?= $image; ?>" alt="" style="height:150px;"/></a>
					 <h2><?=$productName;?></h2>
					 <p><span class="price"><?=$price;?> $</span></p>
				     <div class="button"><span><a href="details.php?proId=<?=$productId;?>" class="details">Details</a></span></div>
				</div>
				 <?php } }else{?>
				 <p style="padding:30px 10px;font-size:30px;font-weight:bold;background-color:green;color:black;text-align:center;">Here have No product for this value!!!</p>
				 <?php } ?>
			</div>
			
		
			
    </div>
 </div>
<?php require_once("inc/footer.php"); ?>