<?php
header("Content-Type:text/xml; charset=UTF-8");
session_start();

?>


<content>
<error><?php if($_SESSION['error']['email']): ?>error<?php endif; ?></error>
</content>