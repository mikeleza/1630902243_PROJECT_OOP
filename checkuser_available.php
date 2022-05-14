<?php

    include_once('function.php');

    $usernamecheck = new DB_con();

    $uname = $_POST['username'];
    if($uname != null){
    $sql = $usernamecheck->usernameavailable($uname);

    $num = mysqli_num_rows($sql);

    if ($num > 0){
        echo "<span style='color: red';>Username already Used.</span>";
        echo "<script>$('#btn-register').prop('disabled',true);</script>";
    } else {
        echo "<span style='color: green';>Username availabe for registration.</span>";
        echo "<script>$('#btn-register').prop('disabled',false);</script>";
    }} else if($uname == null){
        echo "<span style='color: red';>Please Enter Username.</span>";
        echo "<script>$('#btn-register').prop('disabled',true);</script>";
    }
?>