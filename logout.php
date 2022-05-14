<?php
    session_start();
    session_destroy();
    header("location: firstpage.php?x=main&page=&userid=&R=&C=");
?> 