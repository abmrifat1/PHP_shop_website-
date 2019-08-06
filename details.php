<?php require_once("inc/header.php"); ?>
<?php
    if(!isset($_GET['proId']) || $_GET['proId'] == NULL){
        echo "<script>window.location = 'index.php';</script>";
    }else{
        $id = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['proId']);
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $quantity = $_POST['quantity']; 
        if($quantity <= 0){}else{
        $addCart = $ct->addToCart($quantity,$id);
        }
    }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">
                    <?php
                        $getPd = $pd->getSingleProduct($id);
                        while($product = $getPd->fetch_assoc()){                  
                    ?>
						
					<div class="grid images_3_of_2">
						<img src="admin/upload/<?=$product['image'];?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?=$product['productName'];?></h2>				
					<div class="price">
						<p>Price: <span><?=$product['price'];?> $</span></p>
						<p>Category: <span><?=$product['catName'];?></span></p>
						<p>Brand:<span><?=$product['brandName'];?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
            <?php if(isset($addCart)){echo "<span style='color:#880e0e;display:block;margin-top:15px;font-size:20px;'>$addCart</span>";} ?>
		        </div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<?=$product['body'];?>
	    </div>
				<?php } ?>
	        </div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					
					<ul>
                      <?php 
                            $getCategory = $pd->getAllCategory();
                            foreach($getCategory as $category){
                        ?>
				      <li><a href="productbycat.php?catId=<?=$category['catId'];?>"><?=$category['catName'];?></a></li>
				      <?php } ?>
    				</ul>
    	
 				</div>
 		</div>
        <div class="about-us" style="background-color: orangered;width: 100%;height: 200px">
            <div style="float: left;width: 40%">
                <h1 style="font-size: 50px;padding: 60px">Unique</h1>
            </div>
            <div style="float: right;width: 40%;padding-top: 70px">
                <button style="background-color: #dddddd;border-radius: 40px;font-size: 20px;padding: 10px 50px"><a href="about.php">About Us</a></button>
            </div>
        </div>
        <div class="footer-image">
            <img src="images/brands.PNG" style="width:100%;height:400px"/>
        </div>
 	</div>
<?php require_once("inc/footer.php"); ?>