<?php

$filepath = realpath(dirname(__FILE__));
require_once ($filepath .'/../lib/Database.php');
require_once ($filepath .'/../helpers/Format.php');
?>
    <?php

class Cart {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function addToCart($quantity,$id){
        $quantity = mysqli_real_escape_string($this->db->link, $this->fm->validation($quantity));
        $productId= mysqli_real_escape_string($this->db->link, $this->fm->validation($id));
        $sId = session_id();
        $squery = "select * from tbl_product where productId='$productId'";
        
        $result = $this->db->select($squery)->fetch_assoc();
        $productName = $result['productName'];
        $price = $result['price'];
        $image = $result['image'];
        
        $ckQuery = "select * from tbl_cart where productId='$productId' AND sId='$sId'";
        if($this->db->select($ckQuery)){
            $msg = "Product Already Inserted";
            return $msg;
        }else{
        
        $query = "INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) values('$sId','$productId','$productName','$price','$quantity','$image')";
        if($this->db->insert($query)){
            header("Location:cart.php");
        }else{
            header("Location:index.php");
        }
        }
    }
    public function getCartProduct(){
        $sId = session_id();
        $query = "select * from tbl_cart where sId='$sId'";
        $result = $this->db->select2($query);
        if($result){
            return $result;
        }
    }
    public function updateCartQuantity($quantity,$cartId){
        $quantity = mysqli_real_escape_string($this->db->link,$this->fm->validation($quantity));
        $cartId = mysqli_real_escape_string($this->db->link,$this->fm->validation($cartId));
        $query = "UPDATE tbl_cart SET quantity='$quantity' WHERE cartId='$cartId'";
        if($this->db->update($query)){
            $msg = "<span style='color:green;font-size:20px;display:block;margin:10px 0;'>Quantity Update Success</span>";
            return $msg;
        }else{
            $msg = "<span style='color:red;font-size:20px;display:block;margin:10px 0;'>Something Wrong</span>";
            return $msg;
        }
    }
    public function deleteCart($delProCartId){
       $cartId = mysqli_real_escape_string($this->db->link,$this->fm->validation($delProCartId));
        $query = "DELETE FROM tbl_cart WHERE cartId='$cartId'";
        if($this->db->delete($query)){
            $msg = "<span style='color:red;font-size:20px;display:block;margin:10px 0;'>Product Remove Success</span>";
            return $msg;
        }else{
            $msg = "<span style='color:red;font-size:20px;display:block;margin:10px 0;'>Something Wrong</span>";
            return $msg;
        }
        
    }
    public function checkCart(){
         $sId = session_id();
        $query = "select * from tbl_cart where sId='$sId'";
        $result = $this->db->select($query);
        if($result){
            return true;
        }
    }
    public function deleteCustomerCart(){
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId='$sId'";
        $this->db->delete($query);
    }
    public function orderProduct($userId,$userName,$sId){
        $cartQuery = "SELECT * FROM tbl_cart WHERE sId='$sId'";
        $result = $this->db->select2($cartQuery);
        foreach($result as $value){
            $productId = $value['productId'];
            $productName = $value['productName'];
            $image = $value['image'];
            $quantity = $value['quantity'];
            $price = $value['price'];
            $orderQuery = "INSERT INTO tbl_order(userId,userName,productId,productName,image,quantity,price) values('$userId','$userName','$productId','$productName','$image','$quantity','$price')";
            $confirmOrder = $this->db->insert($orderQuery);
            if($confirmOrder){
                return false;
            }
        }
        return true;
        
    }
}

?>
