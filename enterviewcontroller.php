<?php
    header("Content-Type:text/xml; charset=UTF-8");
    session_start();
    mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
    mysql_select_db('norimit_lovelog');
    mysql_query('SET NAMES UTF8');
    
    
    $_SESSION['join']['email'] = $_POST['email'];
    $_SESSION['join']['password'] = $_POST['password'];

    
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
<content>
<error><?php if($_SESSION['error']['email']): ?>error<?php endif; ?></error>
<pmessage><?php echo htmlspecialchars($table, ENT_QUOTES, 'UTF-8');?></pmessage>
</content>