
<?php  
    if(isset($_POST['btnsumbit'])){
    $uid = $_POST['uid'];
    $sql = $bookdata->deletebook($uid);

    if ($sql)
    echo "<script>windows.location.href='firstpage.php?x=bookinfo&page=&userid=11&R=admin'</script>";
    }

    $num_rows = $bookdata->numRows("SELECT * FROM tblebooks ");

    $limit_page = 6 ;
    $page = $Cpage;
    $limit_start = ($page*$limit_page)-$limit_page;

    $num_page = $num_rows/$limit_page;
    if(!($num_page == (int)$num_page))
    $num_page = (int)$num_page+1;
?>
<table id="mytable" class="table table-borderd table-striped text-center">
    <thead class="text-center">
        <th>ID</th>
        <th >image</th>
        <th width="15%">Book Name</th>
        <th>Author</th>
        <th>Publisher</th>
        <th>Category</th>
        <th>Score</th>
        <th>price</th>
        <th>Stock</th>
        
    </thead>
    <tbody>
     <?php 
         $book_a = $bookdata->runQuery("SELECT * FROM tblebooks INNER JOIN cbook ON tblebooks.category = cbook.cid ORDER BY ID ASC LIMIT $limit_start,$limit_page");
         if(!empty($book_a)){
             foreach($book_a as $key => $value){
     ?>

        
        <tr>
        <th><?php echo $book_a[$key]['ID'];?></th>
        <th><img src="upload/<?php echo $book_a[$key]['image'];?>" style="width:150px; heigh:150px;" alt="image"></th>
        <th><?php echo $book_a[$key]['bookname'];?></th>
        <th><?php echo $book_a[$key]['author'];?></th>
        <th><?php echo $book_a[$key]['publisher'];?></th>
        <th><?php echo $book_a[$key]['cname'];?></th>
        <th><?php echo $book_a[$key]['score'];?></th>
        <th><?php echo $book_a[$key]['price'];?></th>
        <th><?php echo $book_a[$key]['stock'];?></th>
        <th><a href="firstpage.php?x=updatebook&page=&userid=<?php echo $_SEESION['id'];?>&R=<?php echo $role;?>&id=<?php echo $book_a[$key]['ID']?>" class="btn btn-primary">Edit</a></th>
        <th>
        <form method="post">
        <input type="text" name="uid" class="form-control" value="<?php echo $book_a[$key]['ID'];?>" style="display:none;">
        <button type="submit" id="btnsumbit" name="btnsumbit" class="btn btn-danger px-4" >Delete</button>
        </a>
        </form>  
        </th>
        </tr>
        


    <?php }}?>

</tbody>
</table>


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
      <a class="page-link" href="?x=bookinfo&page=<?php echo $page-1?>&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>">Previous</a>
      </li>
      <?php }?>
    

    
<!---->
      <?php
        if($page >= 5 ){
      ?>
      <li class="page-item ">
      <a class="page-link" href="?x=bookinfo&page=1&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>">1</a>
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
      <li class="page-item"><a class="page-link" href="?x=bookinfo&page=<?php echo $i?>&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>"><?php echo $i?></a></li>
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
      <a class="page-link" href="?x=bookinfo&page=<?php echo $num_page;?>&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>"><?php echo $num_page;?></a>
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
      <a class="page-link" href="?x=bookinfo&page=<?php echo $page+1;?>&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role;?>">Next</a>
      </li>
      <?php }?>
<!---->
