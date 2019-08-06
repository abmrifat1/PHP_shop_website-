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
    public function newUserAccount($data, $file) {
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

}

?> 