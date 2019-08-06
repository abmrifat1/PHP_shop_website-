<?php require_once("inc/header.php"); ?>
<?php require_once("inc/slider.php"); ?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>New Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
                $getNpd = $pd->getNewProduct();
                if($getNpd){
                    foreach ($getNpd as $newPd){
                        extract($newPd);

            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php?proId=<?=$productId;?>"><img src="admin/upload/<?=$image;?>" alt="" style="height:190px;width:130px"/></a>
                <h2><?=$productName;?></h2>
                <p><?=$fm->textShorten($body,30);?></p>
                <p><span class="price"><?=$price;?> $</span></p>
                <div class="button"><span><a href="details.php?proId=<?=$productId;?>" class="details">Details</a></span></div>
            </div>  
            <?php }}?>
        </div>

        <div class="find-us" style="background-color: orange;width: 100%;height: 200px">
            <div style="float: left;width: 40%">
             <h1 style="font-size: 50px;padding: 60px">Unique</h1>
            </div>
            <div style="float: right;width: 40%;padding-top: 70px">
                <button style="background-color: #dddddd;border-radius: 40px;font-size: 20px;padding: 10px 50px"><a href="contact.php">Find Us</a></button>
            </div>
        </div>
        <div class="content_bottom">
            <div class="heading">
                <h3>Feature Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $getFpd = $pd->getFeaturedProduct();
            if($getFpd){
            foreach ($getFpd as $featurePd) {
                ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php?proId=<?= $featurePd['productId']; ?>"><img src="admin/upload/<?= $featurePd['image']; ?>" alt="" style="height:190px;width:130px;"/></a>
                    <h2><?= $featurePd['productName']; ?></h2>

                    <p><?= $fm->textShorten($featurePd['body'], 30); ?></p>
                    <p><span class="price">$<?= $featurePd['price']; ?></span></p>
                    <div class="button"><span><a href="details.php?proId=<?=$featurePd['productId']; ?>" class="details">Details</a></span></div>
                </div>
            <?php }} ?>

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