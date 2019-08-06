<?php require_once("inc/header.php"); ?>
<?php if(Session::get("userLogin") != TRUE){
    header("Location:login.php");
}
?>
<?php
    if(!isset($_GET['customerId']) || $_GET['customerId'] == "NULL"){
        header("Location:Profile.php");
    }
    $customerId = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['customerId']);
?>
   <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $updateCustomer = $cmr->updateCustomerInfo($_POST);   
    }

    ?>
   
<?php
    $customer = $cmr->getCustomerDetails($customerId);
    if($customer){
        extract($customer); 
?>
<style>
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
    .medium{
        color:brown;
        font-size:17px;
        height:30px;
        padding:5px;
        width:320px;
    }

</style>
<div class="main">
<h2 class="headingInfo">Update Profile Information</h2>
<?php if(isset($updateCustomer)) echo $updateCustomer; ?>
<form action="" method="post">
    <table class="tblone design">
        <tr>
            <td width="25%">Name</td>
            <td width="5%">:</td>
            <td>
                <input type="text" value="<?=$name;?>" name="name" class="medium"/>
            </td>
        </tr>
        <tr>
            <td width="25%">Country</td>
            <td width="5%">:</td>
            <td>
                <input type="text" value="<?=$country;?>" name="country" class="medium"/>
            </td>
        </tr>
        <tr>
            <td width="25%">City</td>
            <td width="5%">:</td>
            <td>
                <input type="text" value="<?=$city;?>" name="city" class="medium"/>
            </td>
        </tr>
        <tr>
            <td width="25%">Zip</td>
            <td width="5%">:</td>
            <td>
                <input type="text" value="<?=$zip;?>" name="zip" class="medium"/>
            </td>
        </tr>
        <tr>
            <td width="25%">Address</td>
            <td width="5%">:</td>
            <td>
                <input type="text" value="<?=$address;?>" name="address" class="medium"/>
            </td>
        </tr>
        <tr>
            <td width="25%">Mobile</td>
            <td width="5%">:</td>
            <td>
                <input type="text" value="<?=$phone;?>" name="phone" class="medium"/>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="hidden" name="customerId" value="<?=$customerId;?>"></td>
            <td><input type="submit" name="update" value="Update Details"></td>
        </tr>
        <?php } ?>
    </table>
</form>

</div>
<div class="clear"></div>
</div>
</div>
<?php require_once("inc/footer.php"); ?>
