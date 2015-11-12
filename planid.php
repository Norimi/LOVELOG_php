<?php
	session_start();    
    
    //すべての変数をsessionへ入れていく。余分なセッションは使わない。
    
    $_SESSION['planid']=$_POST['planid'];
  
    

?>