<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';?>
<?php include '../classes/Product.php';?>
<?php include '../classes/Brand.php';?>
<?php include_once "../lib/Format.php";?>
<?php include_once "../lib/Database.php";?>
<?php
$fm = new Format();
$db = new Database();
?>
<?php
$pd = new Product();

if(isset($_GET['productId'])){
	 $proId = $fm->validation( $_GET['productId']);
	 $proId = mysqli_real_escape_string($db->link,$proId);
}

	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
		$updateProduct = $pd->updateProduct($_POST,$_FILES,$proId);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Product</h2>
        <div class="block">
           <?php
           if(isset($updateProduct)){
           echo $updateProduct;
           }
          ?>
          <?php
          $getPro = $pd->getProById($proId);
          if($getPro){
          	while($res = $getPro->fetch_assoc()){
         ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName"  value="<?php echo $res['productName'];?>" class="medium" />
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
                            if($getCat){
                            while($result = $getCat->fetch_assoc()){
                            ?>
                            <option
                            <?php
                            if($res['catId'] == $result['catId']){ ?>
                            selected="selected"
                            <?php
                            }
                           ?>
                            value="<?php echo $result['catId'];?>"><?php echo $result['catName'];?>
                            </option>
                            <?php
                            }}
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
                   $brand = new Category();
                   		$getBrand = $brand->getAllBrand();
                   if($getBrand){
                 	  while($result = $getBrand->fetch_assoc()){
                   ?>
                            <option 
                            <?php
                            if($res['brandId'] == $result['brandId']){ ?>
                            selected="selected"
                            <?php
                            }
                            ?>
                            value="<?php echo $result['brandId'];?>"><?php echo $result['brandName'];?></option>
                        <?php
                        }}
                        ?>
                        </select>
                        
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body" ><?php echo $res['body'];?></textarea>
                    </td>
                </tr>
                
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $res['price'];?>" class="medium" />
                    </td>
                </tr>
                
                <tr>
            		<td>
               			  <label>After Price</label>
            		  </td>
             	 	   <td>
              			  <input type="number" name="delprice" value="<?php echo $res['delPrice'];?>" class="medium" />
           		    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                    <img height='90px' width='130px' src="<?php echo $res['image'];?>" />
                     <br/>   <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                   			<?php
                   			if($res['type']==0){?>
                            <option selected="selected" value="0">Featured</option>
                            <option value="1">Non-Featured</option>
                            <?php
                            }else{ ?>
                            <option  value="0">Featured</option>
                            <option selected="selected" value="1">Genarel</option>
                            <?php
                            }
                           ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
                <?php
                }}
               ?>
            </table>
            </form>
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
<?php include 'inc/footer.php';?>