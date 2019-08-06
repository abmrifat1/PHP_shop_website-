<?php require_once("inc/header.php"); ?>
<?php
    if(!isset($_GET['catId']) || $_GET['catId'] == NULL){
        echo "<script>window.location = 'index.php';</script>";
    }else{
        $catId = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['catId']);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest And New Product </h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	        <?php
                $getProduct = $pd->getProductByCategoryId($catId);  
                if($getProduct){
                   foreach($getProduct as $product){
                       extract($product);
                    
            ?>
				<div class="grid_1_of_4 images_1_of_4">
				     <a href="details.php?proId=<?=$productId;?>"> <img src="admin/upload/<?= $image; ?>" alt="" height="190"/></a>
					 <h2><?=$productName;?></h2>
					 <p><?=$fm->textShorten($body,30); ?></p>
					 <p><span class="price"><?=$price;?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?=$productId;?>" class="details">Details</a></span></div>
				</div>
             <?php } }else{
                echo "<span style='color:red;font-size:20px;display:block;margin:10px 0;'>Category is empty now</span>";
             } ?>
			</div>

	
	
    </div>
 </div>
<?php require_once("inc/footer.php"); ?>