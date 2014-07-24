<?php

    session_start();
    
    
    mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
    mysql_select_db('noriming_lovelog');
    mysql_query('SET NAMES UTF8');


    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['name'] = $_POST['name'];
    
    
    
    $sql = sprintf('SELECT * FROM ld2members WHERE email="%s"',
                   mysql_real_escape_string($_POST['email'])
    );
    $record = mysql_query($sql) or die(mysql_error());
    $table = mysql_num_rows($record);
    
    if($table > 0){
        
        $_SESSION['error']['email'] = $_POST['email'];
        
        
    } else {

        $_SESSION['error']['email'] = '';
        
    }
    



?>
