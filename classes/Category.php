<?php

require_once '../lib/Database.php';
require_once '../helpers/Format.php';
?>
<?php

class Category {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function catInsert($catName) {
        $catName = mysqli_real_escape_string($this->db->link, $this->fm->validation($catName));
        if (empty($catName)) {
            $catmsg = "<span class='error'>Category name must not be empty<span>";
            return $catmsg;
        } else {
            $query = "insert into tbl_category(catName) values('$catName')";
            $result = $this->db->insert($query);
            if ($result) {
                $catmsg = "<span class='success'>Category insert suceess</span>";
                return $catmsg;
            } else {
                $catmsg = "<span class='error'>Category insert Failed</span>";
                return $catmsg;
            }
        }
    }

    public function getAllCat() {
        $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $result = $this->db->select2($query);
        return $result;
    }

    public function delCatById($id) {
        $query = "DELETE FROM tbl_category where catId = '$id'";
        if ($this->db->delete($query)) {
            $catmsg = "<span class='success'>Category delete suceess</span>";
            return $catmsg;
        } else {
            $catmsg = "<span class='error'>Category delete Failed</span>";
            return $catmsg;
        }
    }

    public function getCatById($id) {
        $query = "SELECT * FROM tbl_category where catId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function catUpdate($catName, $id) {
        $catName = mysqli_real_escape_string($this->db->link, $this->fm->validation($catName));
        if (empty($catName)) {
            $catmsg = "<span class='error'>Category name must not be empty<span>";
            return $catmsg;
        } else {
            $query = "UPDATE tbl_category SET catName='$catName' WHERE catId='$id'";

            if ($this->db->update($query)) {
                $catmsg = "<span class='success'>Category update suceess</span>";
                return $catmsg;
            } else {
                $catmsg = "<span class='error'>Category update Failed</span>";
                return $catmsg;
            }
        }
    }

}

?>