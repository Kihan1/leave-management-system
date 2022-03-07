<?php
require('top.inc.php');
if($_SESSION['ROLE']!=1){
	header('location:add_employee.php?id='.$_SESSION['USER_ID']);
	die();
}
$programmes='';
$id='';
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	$res=mysqli_query($con,"select * from programmes where id='$id'");
	$row=mysqli_fetch_assoc($res);
	$programmes=$row['programmes'];
}
if(isset($_POST['programmes'])){
	$programmes=mysqli_real_escape_string($con,$_POST['programmes']);
	if($id>0){
		$sql="update programmes set programmes='$programmes' where id='$id'";
	}else{
		$sql="insert into programmes(programmes) values('$programmes')";
	}
	mysqli_query($con,$sql);
	header('location:index.php');
	die();
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>programmes</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="post">
							   <div class="form-group">
								<label for="programmes" class=" form-control-label">programmes Name</label>
								<input type="text" value="<?php echo $programmes?>" name="programmes" placeholder="Enter your programmes name" class="form-control" required></div>

							   <button  type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							  </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

<?php
require('footer.inc.php');
?>
