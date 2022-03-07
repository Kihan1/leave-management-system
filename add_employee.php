<?php
require('top.inc.php');
$name='';
$email='';
$mobile='';
$programme_id='';
$RegistrationNumber='';
$birthday='';
$id='';
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	if($_SESSION['ROLE']==2 && $_SESSION['USER_ID']!=$id){
		die('Access denied');
	}
	$res=mysqli_query($con,"select * from students where id='$id'");
	$row=mysqli_fetch_assoc($res);
	$name=$row['name'];
	$email=$row['email'];
	$mobile=$row['mobile'];
	$programme_id=$row['programme_id'];
	$RegistrationNumber=$row['RegistrationNumber'];
	$birthday=$row['birthday'];
}
if(isset($_POST['submit'])){
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
	$pwd=mysqli_real_escape_string($con,$_POST['password']);
	$password=md5($pwd);
	$programme_id=mysqli_real_escape_string($con,$_POST['programme_id']);
	$RegistrationNumber=mysqli_real_escape_string($con,$_POST['RegistrationNumber']);
	$birthday=mysqli_real_escape_string($con,$_POST['birthday']);
	if($id>0){
		$sql="update students set name='$name',email='$email',mobile='$mobile',password='$password',programme_id='$programme_id',RegistrationNumber='$RegistrationNumber',birthday='$birthday' where id='$id'";
	}else{
		$sql="insert into students(name,email,mobile,password,programme_id,RegistrationNumber,birthday,role) values('$name','$email','$mobile','$password','$programme_id','$RegistrationNumber','$birthday','2')";
	}
	mysqli_query($con,$sql);
	header('location:employee.php');
	die();
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Leave Type</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="post">
							   <div class="form-group">
									<label class=" form-control-label">Name</label>
									<input type="text" value="<?php echo $name?>" name="name" placeholder="Enter students name" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Email</label>
									<input type="email" value="<?php echo $email?>" name="email" placeholder="Enter students email" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Mobile</label>
									<input type="text" value="<?php echo $mobile?>" name="mobile" placeholder="Enter students mobile" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Password</label>
									<input type="password"  name="password" placeholder="Enter students password" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">programmes</label>
									<select name="programme_id" required class="form-control">
										<option value="">Select programmes</option>
										<?php
										$res=mysqli_query($con,"select * from programmes order by programmes desc");
										while($row=mysqli_fetch_assoc($res)){
											if($programme_id==$row['id']){
												echo "<option selected='selected' value=".$row['id'].">".$row['programmes']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['programmes']."</option>";
											}
										}
										?>
									</select>
								</div>
								<div class="card">
									<label class=" card-label">RegistrationNumber</label>
									<input type="text" value="<?php echo $RegistrationNumber?>" name="RegistrationNumber" placeholder="Enter students RegistrationNumber" class="form-control" required>
								</div>
								<div class="card">
									<label class=" card-label">Birthday</label>
									<input type="date" value="<?php echo $birthday?>" name="birthday" placeholder="Enter students birthday" class="form-control" required>
								</div>
							   <?php if($_SESSION['ROLE']==1){?>
							   <button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <?php } ?>
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
