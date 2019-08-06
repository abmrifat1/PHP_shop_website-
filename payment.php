<?php require_once("inc/header.php"); ?>
<?php
    if(Session::get("userLogin") != TRUE){
        header("Location:login.php");
    }
?>
<?php
if($ct->checkCart() != TRUE){
    header("Location:index.php");
}
?>
<style>
    .PaymentInfo {
        margin: 0 auto;
        background-color: antiquewhite;
        padding: 5px;
        font-size: x-large;
        font-weight: 700;
        color: chocolate;
        min-height: 150px;
        text-align: center;
    }
    
    .PaymentInfo h2 {
        background-color: aliceblue;
        padding: 15px 0;
    }
    
    .PaymentInfo {
        background-color: aliceblue;
        padding: 15px 0;
    }
    
    .leftPay {
        background-color: beige;
        float: left;
        padding: 35px;
        width: 40%;
    }
    
    .rightPay {
        background-color: beige;
        float: right;
        padding: 35px;
        width: 40%;
    }
    .back{
        margin: 0 auto;
        text-align: center;
        background-color: #dddddd;
    }
    .back a{
        display: inline-block;
        background-color: #2d73b1;
        padding: 20px 60px;
        text-decoration: none;
        font-weight: bold;
        font-size: 20px;
    }
</style>
<div class="main">
    <div class="content">
        <div class="PaymentInfo">
            <h2>Your Choice</h2>
            <div class="leftPay"><a href="paymentOfline.php">Ofline Payment</a></div>
            <div class="#"><a href="paymentOnline.php">Online Payment</a></div>
        </div>
            <div class="back"><a href="cart.php">Back to Cart</a></div>

    </div>
    <?php require_once("inc/footer.php"); ?>
