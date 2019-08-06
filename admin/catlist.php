<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
$catlist = new Category();
if(isset($_GET['delCatId'])){
    $id = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['delCatId']);
    $delCat = $catlist->delCatById($id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php
            if(isset($delCat)){
                echo $delCat;
            }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getCat = $catlist->getAllCat();
                    if ($getCat) {
                        $i = 0;
                        foreach ($getCat as $categorylist) {
                            ?>
                            <tr class="even gradeC">
                                <td><?= ++$i; ?></td>
                                <td><?= $categorylist['catName']; ?></td>
                                <td><a href="catedit.php?catid=<?=$categorylist['catId'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this category')" href="?delCatId=<?=$categorylist['catId'];?>">Delete</a></td>
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

