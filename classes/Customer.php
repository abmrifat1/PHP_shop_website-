<?php
$filepath = realpath(dirname(__FILE__));
require_once ($filepath .'/../lib/Database.php');
require_once ($filepath .'/../helpers/Format.php');
?>
<?php

class Customer {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function newUserAccount($data) {
        $name = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['name']));
        $address = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['address']));
        $city = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['city']));
        $zip = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['zip']));
        $email = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['email']));
        $password = md5(mysqli_real_escape_string($this->db->link, $this->fm->validation($data['password'])));
        $phone = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['phone']));
        $country = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['country']));

        if ($name == "" || $email == "" || $password == "" || $phone == "") {
            $cusmsg = "<span class='error'>Field must not be empty</span>";
            return $cusmsg;
        }
        $mailquery = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
        $mailChk = $this->db->select($mailquery);
        if($mailChk != false){
            $cusmsg = "Account Already Exist!";
            return $cusmsg;
        }
        else {
            $query = "insert into tbl_customer(name,address,city,zip,email,password,phone,country) values('$name','$address','$city','$zip','$email','$password','$phone','$country')";
            if ($this->db->insert($query)) {
                $cusmsg = "<span class='success'>Your Account Created Successfully</span>";
                return $cusmsg;
            } else {
                $cusmsg = "<span class='error'>Something wrong</span>";
                return $cusmsg;
            }
        }
    }
    public function loginUserAccount($data){
        $email = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['email']));
        $password = md5(mysqli_real_escape_string($this->db->link, $this->fm->validation($data['password'])));
        if ($email == "" || $password == "") {
            $cusmsg = "<span class='error'>Field must not be empty</span>";
            return $cusmsg;
        }
        $query = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
        $result = $this->db->select($query);
        if($result != FALSE){
            $value = $result->fetch_assoc();
            Session::set("userLogin",TRUE);
            Session::set("userId",$value['id']);
            Session::set("userName",$value['name']);
            header("Location:cart.php");
        }else{
            $cusmsg = "<span class='error'>Email and password not matched!</span>";
            return $cusmsg;
        }
    }
    public function getCustomerDetails($customerId){
        $query = "SELECT * FROM tbl_customer WHERE id='$customerId'";
        $result = $this->db->select($query)->fetch_assoc();
        return $result;
    }
    public function updateCustomerInfo($data){
        $customerId = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['customerId']));
        $name = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['name']));
        $address = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['address']));
        $city = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['city']));
        $zip = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['zip']));
        $phone = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['phone']));
        $country = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['country']));

        if ($name == "" || $phone == "") {
            $cusmsg = "<span class='error'>Field must not be empty</span>";
            return $cusmsg;
        }
        else {
            $query = "UPDATE tbl_customer SET name='$name',address='$address',city='$city',zip='$zip',phone='$phone',country='$country' WHERE id='$customerId'";
            if ($this->db->update($query)) {
                $cusmsg = "<span class='success'>Your Account Updated Successfully</span>";
                return $cusmsg;
            } else {
                $cusmsg = "<span class='error'>Something wrong</span>";
                return $cusmsg;
            }
        }
    }

}

?> 