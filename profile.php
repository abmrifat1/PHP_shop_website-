<?php require_once("inc/header.php"); ?>
<?php if(Session::get("userLogin") != TRUE){
    header("Location:login.php");
}
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

</style>
<div class="main">
<h2 class="headingInfo">Your Profile Information</h2>

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
        <tr>
            <td></td>
            <td></td>
            <td><a href="editProfile.php?customerId=<?=Session::get("userId");?>">Edit Information</a></td>
        </tr>
        <?php } ?>
    </table>
</div>
<div class="clear"></div>
</div>
</div>
<?php require_once("inc/footer.php"); ?>
