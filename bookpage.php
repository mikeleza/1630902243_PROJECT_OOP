<?php
$uid = $_GET['id'];
$cate = $_GET['C'];


    $sql = $bookdata->fetchbkc($cate,$uid);
    while($row = mysqli_fetch_array($sql)){
?>

<div class="row">
    <div class="col-md-4" >
        <img src="upload/<?php echo $row['image']?>" class="shadow-sm" width="360px" heigh="521px" alt="image">

    </div>

    <div class="col-md-6 shadow-sm p-3 mb-5 bg-body rounded" >
    <div class="row mb-3" >
								
							<h3 class="mb-0"><?php echo $row['bookname']?></h3>
							
							</div>

                            <div class="row mb-3"><h6 class="mb-0">ผู้แต่ง :<?php echo $row['author']?></h6>
							</div>

							<div class="row mb-3">
								<h6 class="mb-0">สำนักพิมพ์ :<?php echo $row['publisher']?></h6>
                                 
							</div>
							<div class="row mb-3"><h6 class="mb-0">หมวดหมู่ :<?php echo $row['cname']?></h6>
				
							</div>
                            <hr>

							<div class="row mb-3">
								
									<h3>เนื้อเรื่อง :</h3><h6 class="mb-0"><?php echo $row['details']?></h6>
			
							</div>
                            <hr>
                            <div class="row mb-3">
								
									<h3 class="mb-0 text-center">ราคา<?php echo $row['price']?> สินค้าในคลัง<?php echo $row['stock']?></h3>
								
									
							
                                
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
								<form action='firstpage.php?x=shopping_cart&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=<?php echo $cate?>&id=<?php echo $uid;?>&action=add' method='post'>
									<button type="submit" id="btnsumbit" name="btnsumbit" class="btn btn-success px-4" style="margin-left:100px;" >BUY</button>
								</form>
								</div>
							</div>
        
    </div>
</div>

<?php }?>