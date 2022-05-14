
<?php  
    if(isset($_POST['btnsumbit'])){
    $uid = $_POST['uid'];
    $sql = $userdata->deleteuser($uid);

    if ($sql)
    echo "<script>windows.location.href='firstpage.php?x=userinfo&page=&userid=11&R=admin'</script>";
    }


    $num_rows = $userdata->numRows("SELECT * FROM tbleusers WHERE role = 'user'");

    $limit_page = 20;
    $page = $Cpage;
    $limit_start = ($page*$limit_page)-$limit_page;

    $num_page = $num_rows/$limit_page;
    if(!($num_page == (int)$num_page))
    $num_page = (int)$num_page+1;
?>

<table id="mytable" class="table table-borderd table-striped">
    <thead>
        <th>id</th>
        <th>image</th>
        <th>username</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Phone number</th>
        <th>Address</th>
        <th>Register Date</th>
        <th>Edit</th>
        <th>Delete</th>
        
    </thead>
    <tbody>
     <?php 
        
            $user_a = $bookdata->runQuery("SELECT * FROM tbleusers WHERE role ='user' ORDER BY id ASC LIMIT $limit_start,$limit_page");
            if(!empty($user_a)){
                foreach($user_a as $key => $value){
        
        ?>

        
        <th><?php echo $user_a[$key]['id']?></th>
        <?php if($user_a[$key]['image']== ''){?>
            <th><img src="upload/Main.png?>" style="width:95px; heigh:95px;" alt="image"></th>    
        <?php }else{?>
            <th><img src="upload/<?php echo $user_a[$key]['image']?>" style="width:95px; heigh:95px;" alt="image"></th>
            <?php }?>
            <th><?php echo $user_a[$key]['username']?></th>
        <th><?php echo $user_a[$key]['firstname']?></th>
        <th><?php echo $user_a[$key]['lastname']?></th>
        <th><?php echo $user_a[$key]['email']?></th>
        <th><?php echo $user_a[$key]['phone']?></th>
        <th><?php echo $user_a[$key]['address']?></th>
        <th><?php echo $user_a[$key]['regdate']?></th>
        <th><a href="firstpage.php?x=updateuser&page=&userid=<?php echo $_SEESION['id'];?>&R=<?php echo $role;?>&id=<?php echo $user_a[$key]['id']?>" class="btn btn-primary">Edit</a></th>
        <th>
        <form method="post">
        <input type="text" name="uid" class="form-control" value="<?php echo $user_a[$key]['id'];?>" style="display:none;">
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
      <a class="page-link" href="?x=userinfo&page=<?php echo $page-1?>&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>">Previous</a>
      </li>
      <?php }?>
    

    
<!---->
      <?php
        if($page >= 5 ){
      ?>
      <li class="page-item ">
      <a class="page-link" href="?x=userinfo&page=1&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>">1</a>
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
      <li class="page-item"><a class="page-link" href="?x=userinfo&page=<?php echo $i?>&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>"><?php echo $i?></a></li>
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
      <a class="page-link" href="?x=userinfo&page=<?php echo $num_page;?>&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>"><?php echo $num_page;?></a>
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
      <a class="page-link" href="?x=userinfo&page=<?php echo $page+1;?>&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role;?>">Next</a>
      </li>
      <?php }?>
<!---->
