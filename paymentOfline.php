<?php require_once("inc/header.php"); ?>
<?php
    $login = Session::get("userLogin");
    if($login == false){
        header("Location:login.php");
    }
?>
<?php
    $getCart = $ct->checkCart();
    if(!$getCart){
        header("Location:index.php");
    }
 ?>

<?php
    if(isset($_GET['orderId']) && $_GET['orderId'] == "order"){
        $sId = session_id();
        $userId = Session::get("userId");
        $userName = Session::get("userName");
        $insertOrder = $ct->orderProduct($userId,$userName,$sId);
        $delcart = $ct->deleteCustomerCart();
        header("Location:success.php?OrderNumber=''");
    }
?>
<style>
    .order {
        margin: 20px auto 0;
        text-align: center;
    }
    
    .order a {
        background-color: bisque;
        padding: 14px 50px;
        font-weight: bold;
        font-size: 20px;
        box-shadow: 2px 2px 6px 2px;
    }
    
    .design {
        width: 550px;
        margin: 0 auto;
        border: 2px solid #ddd;
    }
    
    .design tr td {
        text-align: justify;
    }
    
    .headingInfo {
        margin: 0 auto;
        background-color: antiquewhite;
        padding: 15px 0;
        font-size: x-large;
        font-weight: 700;
        color: chocolate;
        text-align: center;
    }
    .right{
        margin: 20px 0;
    }
</style>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="left">
                <div class="cartpage">
                    <h2>Your Cart</h2>
                    <?= isset($updateCart)?$updateCart:''?>
                        <?= isset($delete)?$delete:''?>
                            <table class="tblone">
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="20%">Product Name</th>
                                    <th width="15%">Price</th>
                                    <th width="25%">Quantity</th>
                                    <th width="20%">Total Price</th>
                                </tr>
                                <?php 
                    $getPro = $ct->getCartProduct();
                    $i=0;
                    $sum = 0;
                    if($getPro){
                    foreach($getPro as $product){
                        extract($product);
                    
                    
                    ?>
                                <tr>
                                    <td>
                                        <?=++$i;?>
                                    </td>
                                    <td>
                                        <?=$productName;?>
                                    </td>
                                    <td>
                                        <?=$price;?><b style="color:red;"> $</b></td>
                                    <td>
                                        <?php echo $quantity;?>
                                    </td>
                                    <td>
                                        <?php $totalPrice = $price*$quantity; echo $totalPrice; $sum += $totalPrice;?><b style="color:red;"> $</b></td>
                                </tr>
                                <?php } ?>
                            </table>
                            <table style="float:right;text-align:left;" width="40%">
                                <tr>
                                    <th>Sub Total : </th>
                                    <td>
                                        <?=$sum;?><b style="color:red;"> $</b></td>
                                </tr>
                                <tr>
                                    <th>VAT : </th>
                                    <td>10% =
                                        <?php $vat = $sum*0.1; echo $vat;?><b style="color:red;"> $</b></td>
                                </tr>
                                <tr>
                                    <th>Grand Total :</th>
                                    <td style='background-color:red;padding:5px;display:inline-block;color:#fff;'>
                                        <?php $gndTotal = $vat + $sum; echo $gndTotal; ?><b> $</b></td>
                                </tr>
                            </table>
                            <?php }else{
                        
                echo "<span style='color:red;font-size:20px;display:block;margin:10px 0;'>Your cart is empty</span>";
            } ?>
                </div>
            </div>
            <div class="right">
                <?php 
        $customerId = Session::get("userId");
        $customer = $cmr->getCustomerDetails($customerId);
        if($customer){
            extract($customer); 
    ?>
                <table class="tblone design">
                    <tr>
                        <td width="25%">Name</td>
                        <td width="5%">:</td>
                        <td>
                            <?=$name;?>
                        </td>
                    </tr>
                    <tr>
                        <td width="25%">Email</td>
                        <td width="5%">:</td>
                        <td>
                            <?=$email;?>
                        </td>
                    </tr>
                    <tr>
                        <td width="25%">Country</td>
                        <td width="5%">:</td>
                        <td>
                            <?=$country;?>
                        </td>
                    </tr>
                    <tr>
                        <td width="25%">City</td>
                        <td width="5%">:</td>
                        <td>
                            <?=$city;?>
                        </td>
                    </tr>
                    <tr>
                        <td width="25%">Zip</td>
                        <td width="5%">:</td>
                        <td>
                            <?=$zip;?>
                        </td>
                    </tr>
                    <tr>
                        <td width="25%">Address</td>
                        <td width="5%">:</td>
                        <td>
                            <?=$address?>
                        </td>
                    </tr>
                    <tr>
                        <td width="25%">Mobile</td>
                        <td width="5%">:</td>
                        <td>
                            <?=$phone;?>
                        </td>
                    </tr>
 
                    <?php } ?>
                </table>
            </div>
            <div class="order">
                <a href="productSuccess.php?orderId=order">Order Product</a>
            </div>

        </div>
        <div class="clear"></div>
    </div>
</div>
<?php require_once("inc/footer.php"); ?>
