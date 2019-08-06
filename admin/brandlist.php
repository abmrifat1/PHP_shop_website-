<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Brand.php'; ?>
<?php
$brandlist = new Brand();
if(isset($_GET['delBrandId'])){
    $id = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['delBrandId']);
    $delbrand = $brandlist->delBrandById($id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Brand List</h2>
        <?php
            if(isset($delbrand)){
                echo $delbrand;
            }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Brand Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getBrand = $brandlist->getAllBrand();
                    if ($getBrand) {
                        $i = 0;
                        foreach ($getBrand as $brandList) {
                            ?>
                            <tr class="even gradeC">
                                <td><?= ++$i; ?></td>
                                <td><?= $brandList['brandName']; ?></td>
                                <td><a href="brandedit.php?brandid=<?=$brandList['brandId'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this Brand')" href="?delBrandId=<?=$brandList['brandId'];?>">Delete</a></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>

