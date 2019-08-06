<?php require_once("inc/header.php"); ?>
<?php

    if(!isset($_GET['userName']) && $_GET['userName'] == NULL){
        header("Location:index.php");
    }
 ?>
<div class="main">
    <div class="content">
        
    </div>
</div>
<?php require_once("inc/footer.php"); ?>