<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';?>
<?php
    if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
        echo "<script>window.location = 'catlist.php';</script>";
    }else{
        $id = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['catid']);
    }
    $catUpdate = new Category(); 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catName = $_POST['catName']; 
        $updateCat = $catUpdate->catUpdate($catName,$id);   
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
                    
               <div class="block copyblock"> 
                   <?php
                        if(isset($updateCat)){
                        echo $updateCat;
                        }
                    ?>
                   <?php
                        $getCat = $catUpdate->getCatById($id);
                        if($getCat){
                            $category = $getCat->fetch_assoc();
                        
                    ?>
                   <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?=$category['catName'];?>" class="medium" name="catName"/>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php }?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>