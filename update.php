<?php
    $uid = $_GET['id'];
    if(isset($_POST['btnsumbit'])){
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $twitter = $_POST['twitter'];
        $instagram = $_POST['Instagram'];
        $fackbook = $_POST['facebook'];
        $email = $_POST['email'];

		$image_file = $_FILES['txt-file']['name'];
		$type = $_FILES['txt-file']['type'];
		$size = $_FILES['txt-file']['size'];
		$temp = $_FILES['txt-file']['tmp_name'];

		$abc = $userdata->fetchonerecord($uid);
		while($row = mysqli_fetch_array($abc)){

		$path = "upload/".$image_file;
		$directory = "upload/";
		if($image_file){
		if($type == "image/jpg" || $type =='image/jpeg' || $type =='image/png' || $type =='image/gif'){
			if (!file_exists($path)){
				if($size < 5000000) {
					if($row['image'] != null){
					unlink($directory.$row['image']);
					move_uploaded_file($temp, 'upload/'.$image_file);
				} else move_uploaded_file($temp, 'upload/'.$image_file);
				} else {
					$errorMsg = "Your file too large please upload 5MB size";
				}
			} else {
				$errorMsg = "File already exists ... Check upload folder";
			}
		} else {
			$errorMsg = "Upload JPG, JPEG, PNG adn GIF file formate...";
		}
		} else {
			$image_file = $row['image'];
		}

		if(!isset($errorMsg)){
			$sql = $userdata->updateuser($fname,$lname,$email,$phone,$address,$twitter,$instagram,$fackbook,$uid,$image_file);
			if($sql){
				header ("location: firstpage.php?x=userinfo&page=&userid=11&R=admin");
			}
		}
	}
	
    }

    $sql = $userdata->fetchonerecord($uid);
    while($row = mysqli_fetch_array($sql)){
?>

<div class="container">
    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="upload/<?php echo $row['image'];?>" alt="image" class="rounded-circle p-1 bg-primary" width="250" height="250">
								<div class="mt-3">
									<h4><?php echo $row['firstname'];?> <?php echo $row['lastname'];?></h4>

									
                                    <input class="form-control" type="file" name="txt-file" id="formFile" value="<?php echo $row['image'];?>">
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
									<input type="text" name="twitter" class="form-control" style="width:225px; heigh:20px;" value="<?php echo $row['twitter'];?>">
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
									<input type="text" name="Instagram" class="form-control" style="width:225px; heigh:20px;" value="<?php echo $row['Instagram'];?>">
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
									<input type="text" name="facebook" class="form-control" style="width:225px; heigh:20px;" value="<?php echo $row['facebook'];?>">
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">First Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="firstname" class="form-control" value="<?php echo $row['firstname'];?>">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Last Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="lastname" class="form-control" value="<?php echo $row['lastname'];?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="email" class="form-control" value="<?php echo $row['email'];?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Phone</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="phone" class="form-control" value="<?php echo $row['phone'];?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Address</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<textarea name="address" class="form-control" value="<?php echo $row['address'];?>"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<button type="submit" id="btnsumbit" name="btnsumbit" class="btn btn-primary px-4" >Save Changes</button>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
</form>
<?php }?>
	</div>