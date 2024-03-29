<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';?>
<?php include '../classes/Product.php';?>

<?php
$pd = new Product();
if(isset($_GET['delete'])){
	$delId = $_GET['delete'];
	$delPro = $pd->delProById($delId);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
        <?php
        if(isset($delPro)){
        	echo $delPro;
        }
       ?>
            <table class="data display datatable" id="example">
			<thead>
			
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>	
					<th>Body</th>
					<th>Price</th>
					<th>Type</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$getPd = $pd->getProductList();
			if($getPd){
			$i=0;
			while($result = $getPd->fetch_assoc()){
			$i++;
			
			?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['productName'];?></td>
					<td><?php echo $result['catName'];?></td>
					<td><?php echo $result['brandName'];?></td>
					<td><?php echo substr($result['body'],9,30);?>..</td>
					<td>$<?php echo $result['price'];?></td>
					
					<td><?php
					if($result['type']==0){
						echo "Featured";
					}else{
						echo "Generel";
					}
					?>
					</td>
					
					<td><img src='<?php echo $result["image"];?>' height="40px" width="60px" /></td>
					<td><a href="productedit.php?productId=<?php echo $result['productId'];?>">Edit</a> || <a href="?delete=<?php echo $result['productId'];?>" onclick= "return confirm('Are you sure to delete this?')">Delete</a></td>
				</tr>
				<?php
				}}
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
<?php include 'inc/footer.php';?>