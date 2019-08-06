<?php require_once("inc/header.php"); ?>
<?php
    $getCart = $ct->checkCart();
    if(!$getCart){
        header("Location:index.php");
    }
 ?>
<?php
if(isset($_GET['delPro'])){
    $delProCartId = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['delPro']);
    $delete = $ct->deleteCart($delProCartId);
}
?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $quantity = $_POST['quantity']; 
        $cartId = $_POST['cartId']; 
        if($quantity <= 0){
            $delete = $ct->deleteCart($cartId);
        }else{
            $updateCart = $ct->updateCartQuantity($quantity,$cartId); 
        }
    }
?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Your Cart</h2>
                <?= isset($updateCart)?$updateCart:''?>
                <?= isset($delete)?$delete:''?>
                <table class="tblone">
                    <tr>
                        <th width="5%">SL</th>
                        <th width="20%">Product Name</th>
                        <th width="20%">Image</th>
                        <th width="15%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="20%">Total Price</th>
                        <th width="5%">Action</th>
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
                        <td><?=++$i;?></td>
                        <td><?=$productName;?></td>
                        <td><img src="admin/upload/<?=$image;?>" alt="" style='width:50px;height:30px;'/></td>
                        <td><?=$price;?><b style="color:red;"> $</b></td>
                        <td>
                            <form action="" method="post">
                                <input type="number" name="quantity" value="<?php echo $quantity;?>" />
                                <input type="hidden" name="cartId" value="<?php echo $cartId;?>" />
                                <input type="submit" name="submit" value="Update" />
                            </form>
                            
                        </td>
                        <td><?php $totalPrice = $price*$quantity; echo $totalPrice; $sum += $totalPrice;?><b style="color:red;"> $</b></td>
                        <td><a onclick="return confirm('Are you sure to remove this product');" href="?delPro=<?=$cartId;?>">X</a></td>
                    </tr>
                    <?php } ?>
                </table>
                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Sub Total : </th>
                        <td><?=$sum;?><b style="color:red;"> $</b></td>
                    </tr>
                    <tr>
                        <th>VAT : </th>
                        <td>10% = <?php $vat = $sum*0.1; echo $vat;?><b style="color:red;"> $</b></td>
                    </tr>
                    <tr>
                        <th>Grand Total :</th>
                        <td style='background-color:red;padding:5px;display:inline-block;color:#fff;'><?php $gndTotal = $vat + $sum; echo $gndTotal; ?><b> $</b></td>
                        <?php Session::set("Total_cost",$gndTotal);?>
                    </tr>
                </table>
                 <?php }else{
                        
                echo "<span style='color:red;font-size:20px;display:block;margin:10px 0;'>Your cart is empty</span>";
            } ?>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
           
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php require_once("inc/footer.php"); ?>
