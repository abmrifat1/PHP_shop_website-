<?php require_once("inc/header.php"); ?>
<?php

    if(!isset($_GET['orderId']) && $_GET['orderId'] == NULL){
        header("Location:index.php");
    }
 ?>
<div class="main">
    <div class="content">
		<?php $ct->deleteCustomerCart(); ?>
        <p style="padding:30px 10px;font-size:30px;font-weight:bold;background-color:green;color:black;text-align:center;">Your Product payment succes...</p>
    </div>
</div>
<?php require_once("inc/footer.php"); ?>