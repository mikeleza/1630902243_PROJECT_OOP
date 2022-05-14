<?php
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

		$path = "upload/".$image_file;
		$directory = "upload/";
		if($image_file){
		if($type == "image/jpg" || $type =='image/jpeg' || $type =='image/png' || $type =='image/gif'){
			if (!file_exists($path)){
				if($size < 5000000) {
					move_uploaded_file($temp, 'upload/'.$image_file);
				} else {
					$errorMsg = "Your file too large please upload 5MB size";
				}
			} else {
				$errorMsg = "File already exists ... Check upload folder";
			}
		} else {
			$errorMsg = "Upload JPG, JPEG, PNG adn GIF file formate...";
		}
		}

		if(!isset($errorMsg)){
			$sql = $bookdata->insertbook($bookname,$author,$publisher,$category,$details,$score,$price,$stock,$image_file);
			if($sql){
				
			}
		}

 }
?><form method="post"  class="form-horizontal" enctype="multipart/form-data">
<div class="row">
	<h1 style="margin-left:81px;">รูปตัวอย่าง</h1>
    <div class="col-md-4" >
        <img src="https://readery.co/media/catalog/product/cache/1/small_image/360x/17f82f742ffe127f42dca9de82fb58b1/9/7/9786167144801.jpg" width="360px" heigh="521px" alt="image">
        <input class="form-control" type="file" name="txt-file" id="formFile" value="<?php echo $row['image'];?>" style="width: 9.5cm; margin-top: 5px;"required/>

    </div>

    <div class="col shadow-sm p-3 mb-5 bg-body rounded" >
    <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Book Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="bookname" class="form-control" value="" required/>
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Author</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="author" class="form-control" value="">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Publisher</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="publisher" class="form-control" value="">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Category</h6>
								</div>

								<select id="category" class="col-sm-9 text-secondary" name="category" 
								style="width: 15.8cm; height:30px; border:0px; outline: none; margin-left:13px;box-shadow: inset 0 0 10px rgb(182, 181, 181);
								border-radius: 5px;font-family:sans-serif,Arial;font-size: 16px;">
									<option selected></option>								
									<option value=1>เรื่องเล่าไทย</option>
									<option value=2>บ้านและสวน</option>
									<option value=3>วิทยาศาสตร์</option>
									<option value=4>ประวัติศาสตร์</option>
									<option value=5>ศิลปวัฒนธรรม</option>
									<option value=6>การเมือง/สังคม</option>
									<option value=7>การเงิน/การลงทุน</option>
									<option value=8>คลาสสิก</option>
									<option value=9>นิยายไซไฟ</option>
									<option value=10>นิยายญี่ปุ่น</option>
									<option value=11>นิยายเกาหลี</option>
									<option value=12>นิยายแฟนตาซี</option>
									<option value=13>นายายฆาตกรรม/สืบสวน</option>
									<option value=14>การฟิกโนเวล/มังงะ</option>
								</select>


							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Details</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="width: 16.5cm; font-family:sans-serif,Arial;font-size: 16px;">
									<textarea name="details" class="form-control" value=""></textarea>
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Score</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="score" class="form-control" value="">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Price</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="price" class="form-control" value=""required/>
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Stock</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="stock" class="form-control" value=""required/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<button type="submit" id="btnsumbit" name="btnsumbit" class="btn btn-success px-4" >Insert</button>
								</div>
							</div>
        
    </div>
</div></form>