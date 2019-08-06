<?php require_once 'inc/header.php'; ?>
<?php require_once 'inc/sidebar.php'; ?>
<?php
require_once '../classes/Product.php';
require_once '../helpers/Format.php';
?>
<?php
$pd = new Product();
$fm = new Format();
if(isset($_GET['delProductId'])){
    $id = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['delProductId']);
    $delProduct = $pd->delProductById($id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <?php
            if(isset($delProduct)){
                echo $delProduct;
            }
        
        ?>
        <div class="block">  
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Type</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getPd = $pd->getAllProduct();
                    if ($getPd) {
                        $i = 0;
                        while ($result = $getPd->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?= $i; ?></td>
                                <td><?= $result['productName']; ?></td>
                                <td><?= $result['catName']; ?></td>
                                <td><?= $result['brandName']; ?></td>
                                <td><?= $fm->textShorten($result['body'], 30); ?></td>
                                <td>$<?= $result['price']; ?></td>
                                <td><img src="upload/<?= $result['image']; ?>" height="40" width="60" alt="" style="margin-top:5px;"/></td>
                                <td>
                                    <?= ($result['type'] == 0) ? "Featured" : "General"; ?>
                                </td>

                                <td><a href="productedit.php?productid=<?=$result['productId'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this product')" href="?delProductId=<?=$result['productId'];?>">Delete</a></td>
                            </tr>
                        <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>1
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>
