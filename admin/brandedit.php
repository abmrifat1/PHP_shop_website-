<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>
<?php
    if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL){
        echo "<script>window.location = 'brandlist.php';</script>";
    }else{
        $id = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['brandid']);
    }
    $brandUpdate = new Brand(); 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $brandName = $_POST['brandName']; 
        $updateBrand = $brandUpdate->brandUpdateById($brandName,$id);   
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
                    
               <div class="block copyblock"> 
                   <?php
                        if(isset($updateBrand)){
                        echo $updateBrand;
                        }
                    ?>
                   <?php
                        $getBrand = $brandUpdate->getBrandById($id);
                        if($getBrand){
                            $brand = $getBrand->fetch_assoc();
                        
                    ?>
                   <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?=$brand['brandName'];?>" class="medium" name="brandName"/>
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