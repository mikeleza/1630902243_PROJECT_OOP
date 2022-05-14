<?php 
$cate = $_GET['C'];
$id = $_GET['userid'];
$role = $_GET['R'];
if($cate ==''){
$num_rows = $userdata->numRows("SELECT * FROM tblebooks ");  
}else {
$aaa = $bookdata->fetchcate($cate);
$bbb = mysqli_fetch_array($aaa);
$num_rows = $bookdata->numRows("SELECT * FROM tblebooks INNER JOIN cbook ON tblebooks.category = cbook.cid WHERE cbook.cid = '$cate' ");  
}

$limit_page = 8;
$page = $Cpage;
$limit_start = ($page*$limit_page)-$limit_page;

$num_page = $num_rows/$limit_page;
if(!($num_page == (int)$num_page))
  $num_page = (int)$num_page+1;

?>
<!--สไลด์-->
<?php if($cate == '') {?>

<div class="row ">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://www.phoenixnext.com/pub/media/banner/tmp/_M_Record_of_Ragnarok_Vol.13_EC_3_.jpg" height="550px" class="  w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://www.phoenixnext.com/pub/media/banner/tmp/01-_-32-Banner-1240x700-min.jpg" height="550px" class="  w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://www.phoenixnext.com/pub/media/banner/tmp/_LN_Unnamed_EC.jpg" height="550px" class="  w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>
<?php }?>
<!-- zone admin-->
<?php 
if(isset($role)){
if($role == 'admin') {?>
<div class="row mt-3">
<a href="firstpage.php?x=bookinsert&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>"><button style="margin-left: 32cm;" type="button" class="insertbook" id="insertbook" name="insertbook">เพิ่ม</button></a>
</div>
<?php } }?>
 
<!--โซนหนังสือ-->
<div class="row mt-1 ms-1" >
<?php  

    
    ?>
<div id="product-grid " style="margin:-9px; margin-top:20px;">
<?php 
if($cate == ''){?>
    <h2>หนังสือออกใหม่</h2>
    <?php }else{?>
      <h2><?php echo $bbb['cname']?></h2>
      <?php }?>
    <hr>
      <div class="container" style="margin-left:61px;">
     <?php 
     if($cate ==''){
      $product_array = $bookdata->runQuery("SELECT * FROM tblebooks ORDER BY id DESC LIMIT $limit_start,$limit_page");
     } else {
      $product_array = $bookdata->runQuery("SELECT * FROM tblebooks INNER JOIN cbook on tblebooks.category = cbook.cid WHERE cbook.cid = '$cate' ORDER BY id DESC LIMIT $limit_start,$limit_page");
     }
 
    if(!empty($product_array)){
        foreach($product_array as $key => $value){
          $uid = $product_array[$key]['ID'];
          ?>

    <div class="product-item" style="width: 250px; heigh:400px; margin-bottom:10px;">

    <form action='firstpage.php?x=shopping_cart&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=<?php echo $cate?>&id=<?php echo $uid;?>&action=add' method='post'>
              <div class="product-image">
                  <a href="firstpage.php?x=bookpage&page=&userid=<?php echo $id;?>&R=<?php echo $role;?>&id=<?php echo $uid?>&C=<?php echo $product_array[$key]["category"];?>"><img src="upload/<?php echo $product_array[$key]["image"];?>" height="300px" width="248px" alt="images"></a>
              </div>
            
              <div class="product-title-footer text-center" style="text-overflow: ellipsis; padding: 105px  15px 0 6px; overflow: auto;">
                  
                  <div class="product-title mt-5" style="text-overflow: ellipsis;white-space: normal;overflow: hidden;"><?php echo $product_array[$key]["bookname"];?></div>
                    
                    <div class="product-price" style="margin-top:9px; margin-right:2px;"><?php echo "฿". $product_array[$key]["price"];?></div>
                    
                    <div class="cart-action">
                        <input type="text-item" class="product-quantity ms-1" name="quantity" value="1" size="2" >

                        <?php if($id ==''){?>

                        <input type="submit" value="Add" class="btnAddAction"disabled="true" style="width: 100px; heigh: 30px; margin-right:1px; margin-top: 1px; margin-bottom:13px;"/>
                       
                        <?php } else {?>

                            <input type="submit" value="Add to Cart" class="btnAddAction" style="width: 100px; heigh: 30px; margin-right:1px; margin-top: 1px; margin-bottom:13px; cursor: pointer;"/>
                        
                            <?php }?>
                      </div>

              </div>
                 
        </form>
    </div>
    <?php }}?>
  </div>
  </div>
</div>



<!--ปุ่มตัวเลข-->
<div class="row mt-5" >
<div class="position-relative mt-3">
<div class="position-absolute bottom-0 start-50 translate-middle-x">
<nav aria-label="...">
  <ul class="pagination">
<!---->
      <?php
        if($page <= 1 ){
      ?>
      <li class="page-item disabled">
      <a class="page-link"tabindex="-1" aria-disabled="true">Previous</a>
      </li>
      <?php }else {?>
      <li class="page-item ">
      <a class="page-link" href="?x=main&page=<?php echo $page-1?>&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=<?php echo $cate?>">Previous</a>
      </li>
      <?php }?>
    

    
<!---->
      <?php
        if($page >= 5 ){
      ?>
      <li class="page-item ">
      <a class="page-link" href="?x=main&page=1&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=<?php echo $cate?>">1</a>
      </li>
      <li class="page-item disabled">
      <a class="page-link">...</a>
      </li>

      <?php }?>
  


  <?php

    if($page > $num_page)
        $page = $num_page;
    if($num_page >= 9){
    if($page <= 5){
      $num_start = 1;
      $num_stop = 9;
    }else if ($page > $num_page-4){
      $num_start = $num_page-8;
      $num_stop = $num_page;
    } else{
      $num_start = $page-4;
      $num_stop = $page+4;
    }
  } else {
    $num_start =1;
    $num_stop = $num_page;
  }

      for($i=$num_start;$i<=$num_stop;$i++){
        if($page == $i){
          ?>
              <li class="page-item active" aria-current="page"><a class="page-link" href="#"><?php echo $i?></a>
        </li>
          
  <?php
        } else {
  ?>
      <li class="page-item"><a class="page-link" href="?x=main&page=<?php echo $i?>&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=<?php echo $cate?>"><?php echo $i?></a></li>
  <?php
        } 
      }
  ?>
    <?php
        if($page < $num_page-4 ){
      ?>
      </li>
      <li class="page-item disabled">
      <a class="page-link">...</a>
      </li>
      <li class="page-item ">
      <a class="page-link" href="?x=main&page=<?php echo $num_page;?>&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>"><?php echo $num_page;?></a>
      <?php }?>
<!---->
    <?php
        if($page >= $num_page ){
      ?>
      <li class="page-item disabled">
      <a class="page-link"tabindex="-1" aria-disabled="true">Next</a>
      </li>
      <?php }else {?>
      <li class="page-item ">
      <a class="page-link" href="?x=main&page=<?php echo $page+1;?>&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role;?>&C=<?php echo $cate?>">Next</a>
      </li>
      <?php }?>
<!---->


  </ul>
</nav>
</div>
</div>
</div>
