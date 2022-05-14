<?php 
    include_once ('function.php');
    session_start();
    $userdata = new DB_con();
    $bookdata = new DB_con();
    $_SEESION['id'] = $_GET['userid'];
    $role = $_GET['R'];
    $Cpage = $_GET['page'];
        if($Cpage == '')
            $Cpage = '1';

    if (isset($_POST['submit-regis'])){
        $uname = $_POST['username'];
        $password = $_POST['password'];
        $uemail = $_POST['email'];
        $role = 'user';
        $sql = $userdata->registration($uname,$password,$uemail,$role);

        if ($sql){
            echo "<script>alert('Registor Successful!');</script>";
            echo "<script>windows.location.href='firstpage.php?x=&page=&userid=&R=&C='</script>";
        } else {
            echo "<script>alert('Please try again!');</script>";
            echo "<script>windows.location.href='firstpage.php?x=&page=&userid=&R=&C='</script>";
        }
    }

    if(isset($_POST['btn-login'])){
        $uname = $_POST['username'];
        $password = $_POST['password'];

        $result = $userdata->login($uname,$password);
        $num = mysqli_fetch_array($result);

        if($num >0){ 
            $_SEESION['id'] = $num['id'];
            $_SESSION['name'] = $num['username'];
            $_SEESION['image'] = $num['image'];
            $_SEESION['role'] = $num['role'];
            header("Location: firstpage.php?x=main&page=&userid=".$_SEESION['id']."&R=".$_SEESION['role']."&C=");
        } else {
            echo "<script>alert('Please try again!');</script>";
        }
    }

   
?>


<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        เว็บขายหนังสือออนไลน์
    </title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    </head>
    <body >
        <!--navbar-->
        <section>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id'];?>&R=<?php echo $role;?>&C=">PROJECT OOP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ms-auto me-5 mb-2 mb-lg-0">

            <!-- if else ล็อกอัน  -->
                <?php 

                if($_SEESION['id'] == '') { 
                    ?>
                <li class="nav-item">
                <a href="#" class="login btn btn-dark" id="Login" name="btn-login"><i class="fa fa-unlock-alt"></i>เข้าสู่ระบบ</a>
                <a href="#" class="register btn btn-dark" id="register" name="btn-register"><i class="fa fa-user"></i>สมัครสมาชิก</a>
                </li>      

                <?php } else if($role == "user") { ?>

                <li class="nav-item">
                <a href="#" class="fauser btn btn-dark " id="userform" name="userform"><i class="fa fa-user-circle fa-2x"></i></a>
                </li> 
                <li class="nav-item">
                <a class="nav-link" href="?x=shopping_cart&userid=<?php echo $_SEESION['id']?>&page=&R=<?php echo $role?>" style="margin-right: 33px;"><i class="fas fa-shopping-cart fa-2x"></i> <span id="cart-item" class="badge badge-danger"></span></a>
                </li>
                <?php } else if($role == "admin")  {?>

                <li class="nav-item">
                <a href="#" class="fauser btn btn-dark " id="admin" name="admin"><i class="fa fa-user-circle fa-2x"></i></a>
                </li> 
                <li class="nav-item">
                <a class="nav-link" href="?x=shopping_cart&userid=<?php echo $_SEESION['id']?>&page=&R=<?php echo $role?>" style="margin-right: 33px;"><i class="fas fa-shopping-cart fa-2x"></i> <span id="cart-item" class="badge badge-danger"></span></a>
                </li>
                <?php } ?>
            </ul>


            <div class="user-form">  
                                 
                        <a href="firstpage.php?x=profile&page=&userid=<?php echo $_SEESION['id'];?>&R=<?php echo $role;?>" class="sub-item"><i class="fa fa-id-card"></i>My Profile</a>
                        <a href="#" class="sub-item"><i class="fa fa-list-alt"></i>My Order</a>
                        <a href="firstpage.php?x=shopping_cart&page=&userid=<?php echo $_SEESION['id'];?>&R=<?php echo $role;?>" class="sub-item"><i class="fa fa-shopping-cart"></i>Cart</a>
                        <hr style="background-color:#fff;height:3px;text-align:center;margin-left:20px;margin-right:20px">
                        <a href="logout.php" class="sub-item"><i class="fa fa-sign-out"></i>Logout</a>
            </div>

            <div class="admin-form">  
                        <a href="firstpage.php?x=userinfo&page=&userid=<?php echo $_SEESION['id'];?>&R=<?php echo $role;?>" class="sub-item"><i class="fa fa-id-card"></i>User Info</a>
                        <a href="firstpage.php?x=bookinfo&page=&userid=<?php echo $_SEESION['id'];?>&R=<?php echo $role;?>" class="sub-item"><i class="fa fa-book"></i>Book Info</a>
                        <a href="#" class="sub-item"><i class="fa fa-cog"></i>Dash Board</a>
                        <hr style="background-color:#fff;height:3px;text-align:center;margin-left:20px;margin-right:20px">
                        <a href="logout.php" class="sub-item"><i class="fa fa-sign-out"></i>Logout</a>
            </div>


            


            <!--เป็น form ที่ซ่อนไว้-->
            <div class="login-form">
                <form method="post">
                    <div>
                        <label >USERNAME</label>
                        <input type="text" id="username" name="username" placeholder="Username" required/>
                    </div>
                    <div>
                        <label >PASSWORD</label>
                        <input type="password" id="password" name="password" placeholder="Password" required/>
                    </div>
                    <div>
                        <input type="submit" name="btn-login" id="btn-login" value="LOGIN"/>
                    </div>
                </form>
            </div>

            <div class="register-form">
                <form method="post">
                    <div>
                        <label >USERNAME</label>
                        <input type="text" id="username" name="username" placeholder="Username" onblur="checkusername(this.value)" >
                        <span id="usernameavailable"></span>
                    </div>
                    <div>
                        <label >EMAIL</label>
                        <input type="email" id="email" name="email" placeholder="email" required/>
                    </div>
                    <div>
                        <label >PASSWORD</label>
                        <input type="password" id="password" name="password" placeholder="Password" required/>
                    </div>
                    <div>
                        <input type="submit" name="submit-regis" id="btn-register" value="REGISTER"/>
                    </div>
                </form>
            </div>
        </div>
        </nav>
        </section>
            <!--ปุ่มทางซ้าย-->
            <div class="menu-btn">
            <i class="fas fa-bars"></i>
        </div>
        <div class="side-bar">
            <div class="close-btn">
                <i class="fas fa-times"></i>
            </div>
            <div class="menu">
                <div class="item">
                    <a class="sub-btn"><i class="fas fa-book"></i>หนังสือไทย <i class="fas fa-angle-right dropdown"></i></a>
                    <div class="sub-menu">
                        <a href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=1" class="sub-item">หนังสือเรื่องเล่าไทย</a>
                        <a href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=2" class="sub-item">หนังสือบ้านและสวน</a>
                        <a href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=3" class="sub-item">หนังสือวิทยาศาสตร์</a>
                        <a href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=4" class="sub-item">หนังสือประวัติศาสตร์</a>
                        <a href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=5" class="sub-item">หนังสือศิลปวัฒนธรรม</a>
                        <a href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=6" class="sub-item">หนังสือการเมือง/สังคม</a>
                        <a href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=7" class="sub-item">หนังสือการเงิน/การลงทุน</a>
                    </div>
                    </div>
                <div class="item">
                    <a class="sub-btn"><i class="fas fa-book"></i>หนังสือแปล<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                        <a href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=8" class="sub-item">หนังสือคลาสสิก</a>
                        <a href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=9" class="sub-item">นิยายไซไฟ</a>
                        <a href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=10" class="sub-item">นิยายญี่ปุ่น</a>
                        <a href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=11" class="sub-item">นิยายเกาหลี</a>
                        <a href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=12" class="sub-item">นิยายแฟนตาซี</a>
                        <a href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=13" class="sub-item">นิยายฆาตกรรม/สืบสวน</a>
                        <a href="firstpage.php?x=main&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=14" class="sub-item">กราฟิกโนเวล มังงะ</a>
                    </div>    
                    </div>
            </div>
        </div>

    <!--เว็บที่แสดง-->
    <div class="container mt-5 shadow p-3 mb-5 bg-body rounded">
    <?php
    if(isset($_GET['x'])){
        if($_GET['x']=='' or $_GET['x']=='main') include 'main.php';
        if($_GET['x']=='userinfo') include 'userinfo.php';
        if($_GET['x']=='updateuser') include 'update.php';
        if($_GET['x']=='profile') include 'profile.php';
        if($_GET['x']=='bookinfo') include 'bookinfo.php';
        if($_GET['x']=='bookinsert') include 'bookinsert.php';
        if($_GET['x']=='bookpage') include 'bookpage.php';
        if($_GET['x']=='shopping_cart') include 'shopping_cart.php';
        if($_GET['x']=='updatebook') include 'updatebook.php';

       

    }

       
    ?>
    </div>
                    
    <footer>
        
    </footer>
    <!--script-->

    <!--เช็ค user ตอนสมัคร-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            function checkusername(val){
                $.ajax({
                    type: 'POST',
                    url: 'checkuser_available.php',
                    data: 'username='+val,
                    success: function(data){
                        $('#usernameavailable').html(data);
                    }
                })
            }
        </script>

    <!--ปุ่ม login regis account-->
    <script type="text/javascript">
        $(document).ready(function(){
            var form = $(".login-form");
            var form2 = $(".register-form");
            var form3 = $(".user-form");
            var form4 = $(".admin-form");
            var status = false;
            var status2 = false;
            var status3 = false;
            var status4 = false;
            $("#Login").click(function(event){
                event.preventDefault();
                if(status == false){
                    form.fadeIn();
                    form2.fadeOut();
                    status = true;
                    status2 = false;
                }else{
                    form.fadeOut();
                    status = false;
                }
            });
            $("#register").click(function(event){
                event.preventDefault();
                if(status2 == false){
                    form2.fadeIn();
                    form.fadeOut();
                    status2 = true;
                    status = false;
                }else{
                    form2.fadeOut();
                    status2 = false;
                }
            });
            $("#userform").click(function(event){
                event.preventDefault();
                if(status3 == false){
                    form3.fadeIn();
                    status3 = true; 
                } else {
                    form3.fadeOut();
                    status3 = false;
                }
            });

            $("#admin").click(function(event){
                event.preventDefault();
                if(status4 == false){
                    form4.fadeIn();
                    status4 = true; 
                } else {
                    form4.fadeOut();
                    status4 = false;
                }
            });
        });
    </script>



        <!--side bar-->
        <script type="text/javascript">
            $(document).ready(function(){
               
                $('.sub-btn').click(function(){
                    $(this).next('.sub-menu').slideToggle();
                    $(this).find('.dropdown').toggleClass('rotate');
                });

                $('.menu-btn').click(function(){
                    $('.side-bar').addClass('active');
                    $('.menu-btn').css("visibility", "hidden");
                });

                $('.close-btn').click(function(){
                    $('.side-bar').removeClass('active');
                    $('.menu-btn').css("visibility", "visible");
                });
            });

        </script>
        

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  
    </body>
</html>