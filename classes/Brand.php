<?php
$filepath = realpath(dirname(__FILE__));
require_once ($filepath .'/../lib/Database.php');
require_once ($filepath .'/../helpers/Format.php');
?>
<?php

class Brand {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function brandInsert($brandName) {
        $brandName = mysqli_real_escape_string($this->db->link, $this->fm->validation($brandName));
        if (empty($brandName)) {
            $brandmsg = "<span class='error'>Brand name must not be empty<span>";
            return $brandmsg;
        } else {
            $query = "insert into tbl_brand(brandName) values('$brandName')";
            if ($this->db->insert($query)) {
                $brandmsg = "<span class='success'>Brand insert suceess</span>";
                return $brandmsg;
            } else {
                $brandmsg = "<span class='error'>Brand insert Failed</span>";
                return $brandmsg;
            }
        }
    }

    public function getAllBrand() {
        $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
        $result = $this->db->select2($query);
        return $result;
    }

    public function delBrandById($id) {
        $query = "DELETE FROM tbl_brand where brandId = '$id'";
        if ($this->db->delete($query)) {
            $brandmsg = "<span class='success'>Brand delete suceess</span>";
            return $brandmsg;
        } else {
            $brandmsg = "<span class='error'>Brand delete Failed</span>";
            return $brandmsg;
        }
    }

    public function getBrandById($id) {
        $query = "SELECT * FROM tbl_brand where brandId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function brandUpdateById($brandName, $id) {
        $brandName = mysqli_real_escape_string($this->db->link, $this->fm->validation($brandName));
        if (empty($brandName)) {
            $brandmsg = "<span class='error'>Brand name must not be empty<span>";
            return $brandmsg;
        } else {
            $query = "UPDATE tbl_brand SET brandName='$brandName' WHERE brandId='$id'";

            if ($this->db->update($query)) {
                $brandmsg = "<span class='success'>Brand update suceess</span>";
                return $brandmsg;
            } else {
                $brandmsg = "<span class='error'>Brand update Failed</span>";
                return $brandmsg;
            }
        }
    }

}

?>