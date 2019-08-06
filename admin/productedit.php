<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Product.php'; ?>
<?php include '../classes/Brand.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
    echo "<script>window.location = 'productlist.php';</script>";
} else {
    $productid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productid']);
}
$pd = new Product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateProduct = $pd->productUpdate($_POST, $_FILES, $productid);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <?php
        if (isset($updateProduct)) {
            echo $updateProduct;
        }
        ?>
        <?php
        $getPro = $pd->getProductById($productid);
        if ($getPro) {
            $result = $getPro->fetch_assoc();
            ?>
            <div class="block">               
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="productName" value="<?= $result['productName']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="catId">
                                    <option>Select Category</option>
                                    <?php
                                    $cat = new Category();
                                    $getCat = $cat->getAllCat();
                                    if ($getCat) {
                                        foreach ($getCat as $catList) {
                                            ?>
                                            <option
                                            <?php
                                            if ($result['catId'] == $catList['catId']) {
                                                echo "selected";
                                            }
                                            ?>
                                                value="<?= $catList['catId']; ?>"><?= $catList['catName']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Brand</label>
                            </td>
                            <td>
                                <select id="select" name="brandId">
                                    <option>Select Brand</option>
                                    <?php
                                    $brand = new Brand();
                                    $getBrand = $brand->getAllBrand();
                                    if ($getBrand) {
                                        foreach ($getBrand as $brandList) {
                                            ?>
                                            <option
                                            <?php
                                            if ($result['brandId'] == $brandList['brandId']) {
                                                echo "selected";
                                            }
                                            ?> value="<?= $brandList['brandId']; ?>"><?= $brandList['brandName']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Description</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body" ><?=$result['body'];?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Price</label>
                            </td>
                            <td>
                                <input type="text" name="price" value="<?=$result['price'];?> $" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="upload/<?= $result['image']; ?>" alt="" width="400" height="250"/><br/>
                                <input type="file" name="image" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Product Type</label>
                            </td>
                            <td>
                                <select id="select" name="type">
                                    <option>Select Type</option>
                                    <?php if($result['type'] == 0){ ?>
                                    <option value="0" selected="selected">Featured</option>
                                    <option value="1">General</option>
                                    <?php }else{ ?>
                                    <option value="0">Featured</option>
                                    <option value="1" selected="selected">General</option>
                                    
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>


