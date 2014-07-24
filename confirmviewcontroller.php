<?php
	header("Content-Type:text/xml; charset=UTF-8");
	session_start();
?>


<content>
<email><?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES, 'UTF-8');?></email>
<password><?php echo htmlspecialchars($_SESSION['join']['password'], ENT_QUOTES, 'UTF-8');?></password>
</content>