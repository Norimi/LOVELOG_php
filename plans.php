<?php
	//planid.phpとplanviewcontrollerをひとつにまとめる
	header("Content-Type:text/xml; charset=UTF-8");
	session_start();

	mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
	mysql_select_db('noriming_lovelog');
	mysql_query('SET NAMES UTF8');


	if(isset($_POST['planid'])){
		$_SESSION['planid']=$_POST['planid'];
	}



	if(isset($_POST['title'])){
	    $sql = sprintf('INSERT INTO ld2plan SET userid=%d, category="%s", title="%s", date="%s", budget=%d, created="%s"',
	    mysql_real_escape_string($_REQUEST['userid']),
	    mysql_real_escape_string($_REQUEST['category']),
	    mysql_real_escape_string($_REQUEST['title']),
	    mysql_real_escape_string($_REQUEST['date']),
	    mysql_real_escape_string($_REQUEST['budget']),
	    date('Y-m-d H:i:s')
	    );

		  //chatへの新しいプラン情報の挿入
		mysql_query($sql) or die(mysql_error());
		$planid = mysql_insert_id();
		$category = $_POST['category'];
		$title = $_POST['title'];
		$planmade = 'あたらしいプランをたてました。';
		$plantitle = $_REQUEST['title'];
		$chat = sprintf("%s 「%s」",  $planmade, $plantitle);

		$sql = sprintf('INSERT INTO ld2chat SET userid=%d, chat="%s", date="%s", planid=%d',
		mysql_real_escape_string($_POST['userid']),
		mysql_real_escape_string($chat),
		date('Y-m-d H:i:s'),
		mysql_real_escape_string($planid)
		);
		mysql_query($sql) or die(mysql_error());

	}
	    
	    

	if(isset($_REQUEST['url'])){

	  foreach($_POST['url'] as $url){
	    $sql = sprintf('INSERT INTO ld2planurl SET planid=%d, userid=%d, url="%s", created="%s"',
	      mysql_real_escape_string($planid),
	      mysql_real_escape_string($_POST['userid']),
	      mysql_real_escape_string($url),
	      date('Y-m-d H:i:s')
	    );
	    mysql_query($sql) or die(mysql_error());

	  }
	}


	if(isset($_REQUEST['todo'])){

	  foreach($_POST['todo'] as $todo){
	    $sql = sprintf('INSERT INTO ld2plantodo SET planid=%d,userid=%d, todo ="%s", checked="1", created="%s"',
	      mysql_real_escape_string($planid),
	      mysql_real_escape_string($_POST['userid']),
	      mysql_real_escape_string($todo),
	      date('Y-m-d H:i:s')
	    );
	    mysql_query($sql) or die(mysql_error());
	  }

	}

?>	

	  



