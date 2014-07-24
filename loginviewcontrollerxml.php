<?php
	header("Content-Type:text/xml; charset=UTF-8");
	session_start();
?>


<content>
<flag><?php if($_SESSION['founduser']): ?>ok<?php endif; ?></flag>
<id><?php echo htmlspecialchars($_SESSION['founduser']['memberid']); ?></id>
<pid><?php echo htmlspecialchars($_SESSION['founduser']['partnerid']); ?></pid>
<mname><?php echo htmlspecialchars($_SESSION['founduser']['name']); ?></mname>
<memail><?php echo htmlspecialchars($_SESSION['founduser']['email']); ?></memail>
<pname><?php echo htmlspecialchars($_SESSION['partnername']['name']); ?></pname>
</content>