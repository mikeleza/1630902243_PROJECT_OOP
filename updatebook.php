<?php
$uid = $_GET['id'];
 if(isset($_POST['btnsumbit'])){
     $bookname = $_POST['bookname'];
     $author = $_POST['author'];
     $publisher = $_POST['publisher'];
     $category = $_POST['category'];
     $details = $_POST['details'];
     $score = $_POST['score'];
     $price = $_POST['price'];
     $stock = $_POST['stock'];

        $image_file = $_FILES['txt-file']['name'];
		$type = $_FILES['txt-file']['type'];
		$size = $_FILES['txt-file']['size'];
		$temp = $_FILES['txt-file']['tmp_name'];

        $abc = $bookdata->fetchonebook($uid);
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
			$sql = $bookdata->updatebook($bookname,$author,$publisher,$category,$details,$score,$price,$stock,$image_file,$uid);
			if($sql){
                echo "<script>windows.location.href='firstpage.php?x=bookinfo&page=&userid=11&R=admin</script>";
				
			}
		}
    }
 }

 $sql = $userdata->fetchonebook($uid);
    while($row = mysqli_fetch_array($sql)){

?><form method="post"  class="form-horizontal" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-4" >
        <?php  echo "<img src='upload/".$row['image']."' width='360px' height='521px'>" ?>
        <input class="form-control" type="file" name="txt-file" id="formFile" value="<?php echo $row['image'];?>" style="width: 9.5cm; margin-top: 5px;">

    </div>

    <div class="col shadow-sm p-3 mb-5 bg-body rounded" >
    <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Book Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="bookname" class="form-control" value="<?php echo $row['bookname'];?>" >
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Author</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="author" class="form-control" value="<?php echo $row['author'];?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Publisher</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="publisher" class="form-control" value="<?php echo $row['publisher'];?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Category</h6>
								</div>
								<select id="category" class="col-sm-9 text-secondary" name="category" 
								style="width: 15.8cm; height:30px; border:0px; outline: none; margin-left:13px;box-shadow: inset 0 0 10px rgb(182, 181, 181);
								border-radius: 5px;font-family:sans-serif,Arial;font-size: 16px;" >
									<option selected value="<?php echo $row['category']?>"><?php echo $row['cname']?> (????????????????????????????????????)</option>
									<option value=1>???????????????????????????????????????</option>
									<option value=2>??????????????????????????????</option>
									<option value=3>?????????????????????????????????</option>
									<option value=4>???????????????????????????????????????</option>
									<option value=5>????????????????????????????????????</option>
									<option value=6>????????????????????????/???????????????</option>
									<option value=7>?????????????????????/????????????????????????</option>
									<option value=8>?????????????????????</option>
									<option value=9>???????????????????????????</option>
									<option value=10>????????????????????????????????????</option>
									<option value=11>?????????????????????????????????</option>
									<option value=12>????????????????????????????????????</option>
									<option value=13>????????????????????????????????????/??????????????????</option>
									<option value=14>?????????????????????????????????/???????????????</option>
								</select>


							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Details</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="width: 16.5cm; font-family:sans-serif,Arial;font-size: 16px;">
									<textarea name="details" class="form-control" ><?php echo $row['details']?></textarea>
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Score</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="score" class="form-control" value="<?php echo $row['score'];?>">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Price</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="price" class="form-control" value="<?php echo $row['price'];?>">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Stock</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="stock" class="form-control" value="<?php echo $row['stock'];?>">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<button type="submit" id="btnsumbit" name="btnsumbit" class="btn btn-success px-4" >UPDATE</button>
								</div>
							</div>
        
    </div>
</div>
</form>
<?php }?>