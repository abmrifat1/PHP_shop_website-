<?php
    $filepath = realpath(dirname(__FILE__));
require_once ($filepath .'/../lib/Database.php');
require_once ($filepath .'/../helpers/Format.php');
?>
<?php

class Product {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function productInsert($data, $file) {
        $productName = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['productName']));
        $catId = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['catId']));
        $brandId = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['brandId']));
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['price']));
        $type = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['type']));

        $permited = ['jpg', 'jpeg', 'png', 'gif'];
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_file = "upload/" . $unique_image;

        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" || $file_name == "") {
            $promsg = "<span class='error'>Field must not be empty</span>";
        } elseif (in_array($file_ext, $permited) === false) {
            $promsg = "<span class='error'>You can uploade only :- " . implode(', ', $permited) . " type of image</span>";
        } else {
            move_uploaded_file($file_temp, $uploaded_file);

            $query = "insert into tbl_product(productName,catId,brandId,body,price,type,image) values('$productName','$catId','$brandId','$body','$price','$type','$unique_image')";
            if ($this->db->insert($query)) {
                $promsg = "<span class='success'>Product insert suceess</span>";
                return $promsg;
            } else {
                $promsg = "<span class='error'>Product insert Failed</span>";
                return $promsg;
            }
        }
    }

    public function getAllProduct() {
        /* $query = "SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName from tbl_product inner join tbl_category on tbl_product.catId=tbl_category.catId inner join tbl_brand on tbl_product.brandId=tbl_brand.brandId ORDER BY tbl_product.productId DESC"; */

        $query = "SELECT p.*,c.catName,b.brandName from tbl_product as p,tbl_category as c,tbl_brand as b WHERE p.catId=c.catId AND p.brandId=b.brandId ORDER BY p.productId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProductById($productid) {
        $query = "SELECT * FROM tbl_product where productId = '$productid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function productUpdate($data, $file, $productid) {
        $productName = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['productName']));
        $catId = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['catId']));
        $brandId = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['brandId']));
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['price']));
        $type = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['type']));

        $permited = ['jpg', 'jpeg', 'png', 'gif'];
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_file = "upload/" . $unique_image;

        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
            $promsg = "<span class='error'>Field must not be empty</span>";
        } else {
            if (!empty($file_name)) {
                if (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'>You can uploade only :- " . implode(', ', $permited) . " type of image</span>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_file);

                    $query = "update tbl_product set productName='$productName',catId='$catId',brandId='$brandId',body='$body',price='$price',type='$type',image='$unique_image' where productId='$productid'";
                    $updated_rows = $this->db->update($query);
                    if ($updated_rows) {
                        $promsg = "<span class='success'>Product update suceess</span>";
                        return $promsg;
                    } else {
                        $promsg = "<span class='error'>Product update Failed</span>";
                        return $promsg;
                    }
                }
            } else {
                $query = "update tbl_product set productName='$productName',catId='$catId',brandId='$brandId',body='$body',price='$price',type='$type' where productId='$productid'";
                $updated_rows = $this->db->update($query);
                if ($updated_rows) {
                    $promsg = "<span class='success'>Product update suceess</span>";
                    return $promsg;
                } else {
                    $promsg = "<span class='error'>Product update Failed</span>";
                    return $promsg;
                }
            }
        }
    }

    public function delProductById($id) {
        $getProductData = "select * from tbl_product where productId='$id'";
        $getData = $this->db->select($getProductData);
        if ($getData) {
            while ($deling = $getData->fetch_assoc()) {
                $deling = "upload/" . $deling['image'];
                unlink($deling);
            }
        }
        $query = "DELETE FROM tbl_product where productId = '$id'";
        if ($this->db->delete($query)) {
            $productmsg = "<span class='success'>Product delete suceess</span>";
            return $productmsg;
        } else {
            $productmsg = "<span class='error'>Product delete Failed</span>";
            return $productmsg;
        }
    }

    public function getFeaturedProduct() {
        $query = "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select2($query);
        if($result){
            return $result;
        }
        
    }
    public function getNewProduct(){
        $query = "SELECT * FROM tbl_product where type='1' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select2($query);
        if($result){
            return $result;
        }
    }
    public function getSingleProduct($id){
        $query = "SELECT p.*,c.catName,b.brandName from tbl_product as p,tbl_category as c,tbl_brand as b WHERE p.catId=c.catId AND p.brandId=b.brandId AND p.productId='$id'";
        $result = $this->db->select($query);
        if($result){
            return $result;
        }
    }
    public function getAllCategory(){
        $query = "SELECT * FROM tbl_category ORDER BY catName";
        $result = $this->db->select2($query);
        if($result){
            return $result;
        }
    }
    public function getIpone(){
        $query = "SELECT * FROM tbl_product WHERE brandId='6' AND type='1' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query)->fetch_assoc();
        return $result;
    }
	public function getIponeAll(){
        $query = "SELECT * FROM tbl_product WHERE brandId='6' AND type='1' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
	public function searchProductAll($searchValue){
        $query = "SELECT * FROM tbl_product WHERE (productName like '%$searchValue%' or body like '%$searchValue%') AND type='1'";
        $result = $this->db->select($query);
        return $result;
    }
	
    public function getSamsung(){
        $query = "SELECT * FROM tbl_product WHERE brandId='7' AND type='1' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query)->fetch_assoc();
        return $result;
    }
	public function getSamsungAll(){
        $query = "SELECT * FROM tbl_product WHERE brandId='7' AND type='1' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
    public function getAcer(){
        $query = "SELECT * FROM tbl_product WHERE brandId='8' AND type='1' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query)->fetch_assoc();
        return $result;
    }
	public function getAcerAll(){
        $query = "SELECT * FROM tbl_product WHERE brandId='8' AND type='1' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function getCanon(){
        $query = "SELECT * FROM tbl_product WHERE brandId='9' AND type='1' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query)->fetch_assoc();
        return $result;
    }
	public function getCanonAll(){
        $query = "SELECT * FROM tbl_product WHERE brandId='9' AND type='1' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
    public function getProductByCategoryId($catId){
        $query = "SELECT * FROM tbl_product WHERE catId='$catId' ORDER BY productId DESC LIMIT 8";
        $result = $this->db->select2($query);
        return $result; 
    }
    

}

?>