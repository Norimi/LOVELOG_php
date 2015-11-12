<?php

    header("Content-Type:text/xml; charset=UTF-8");
    session_start();
    mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
    mysql_select_db('norimit_lovelog');
    mysql_query('SET NAMES UTF8');

    
    //lovercodeとlovernumberのふたつを持つuserを検索。ヒットしたらフラッグをたてる
    $sql = sprintf('SELECT * FROM ld2members WHERE passkey=%d AND name="%s"',
                   mysql_real_escape_string($_SESSION['lovernumber']),
                   mysql_real_escape_string($_SESSION['lovername'])
    );
    
    $recordSet = mysql_query($sql) or die(mysql_error());
    $foundlover = mysql_fetch_assoc($recordSet);
    $_SESSION['foundlover'] = $foundlover;  
?>



<content>

<flag><?php
    if($_SESSION['foundlover']):
    ?>ok<?php
    endif;
    ?></flag>
</content>